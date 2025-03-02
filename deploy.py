import os
import pathlib
import subprocess
import urllib
import urllib.request

WEBROOT = "/var/www/html"

def run(command: str, capture=True):
    if capture:
        return bytes.decode(subprocess.run(command, shell=True, capture_output=True).stdout)
    else:
        subprocess.run(command, shell=True, capture_output=False)

def command_is_installed(command: str):
    return run(f"which {command}").startswith("/")

def docker_compose_is_installed():
    return run(f"docker compose version").startswith("Docker Compose")

def is_root():
    return os.geteuid() == 0

def require_root(failure_reason: str):
    if not is_root():
        print(failure_reason)
        print("You're going to need administrator privileges for that. Try running again as root.")
        exit(1)

def permissions_are_broken():
    webroot_permissions = run(f"ls -l /var/www/ | grep html")[1:10]
    if webroot_permissions[7] == "-" or webroot_permissions[8] == "-":
        return True
    
    return False

def fix_permissions(username: str):
    require_root(f"The permissions for {WEBROOT} need changed.")
    run(f"chown -R {username}:{username} {WEBROOT}")
    run(f"chmod -R 777 {WEBROOT}")
    run(f"setfacl -m default:user:{username}:rwx {WEBROOT}")


# Step 1: Make sure we're on Linux.
if not (os.name == "posix"):
    print("Break The Bank only runs on unix. If you're on Windows, try installing the Windows subsystem for Linux and running it there.")
    exit(1)

# Step 2: Make sure webroot exists.
if not pathlib.Path(WEBROOT).exists():
    require_root(f"The directory {WEBROOT} does not exist and needs to be created.")
    os.system(f"mkdir -p {WEBROOT}")

# Step 3: Make sure we can use webroot.
if permissions_are_broken():
    fix_permissions(input("Your username on this system? (for permissions purposes): "))

# Step 4: Put the mysqli script there.
if not pathlib.Path(f"{WEBROOT}/install_mysqli.sh").exists():
    run(f"echo '#!/bin/bash' > {WEBROOT}/install_mysqli.sh")
    run(f"echo 'docker-php-ext-install mysqli' >> {WEBROOT}/install_mysqli.sh")
    run(f"echo 'apachectl restart' >> {WEBROOT}/install_mysqli.sh")
    run(f"chmod +x {WEBROOT}/install_mysqli.sh")

# Step 5: Make sure we have Docker Compose.
if not docker_compose_is_installed():
    if command_is_installed("apt"):
        require_root("Docker Compose V2 does not seem to be installed.")
        run(f"apt install docker-compose-v2")
        if not docker_compose_is_installed():
            print("Can't install Docker Compose via apt. Try 'sudo apt install docker-compose-v2'. If that doesn't work, you'll have to install it manually.")
            exit(1)
    else:
        print("It doesn't look like you have apt. You'll have to install Docker Compose manually.")
        exit(1)

# Step 6: Make sure the docker-compose.yml file is present.
if not pathlib.Path(f"{WEBROOT}/docker-compose.yml").exists():
    print(f"You need to put the docker-compose.yml file in {WEBROOT}.")
    exit(1)

# Step 7: Stop docker if it is already running.
run("docker compose down")

# Step 8: Make sure a web server is not running locally.
try:
    urllib.request.urlopen(urllib.request.Request("http://localhost"))
    print("A web server is currently running. You will need to shut it down before proceeding.")
    exit(1)
except Exception as error:
    pass

# Step 9: Start the containers.
run(f"docker compose -f {WEBROOT}/docker-compose.yml up -d", False)

# Step 10: Install mysqli onto the db container.
run(f"chmod +x {WEBROOT}/install_mysqli.sh")
run(f"docker exec -t www {WEBROOT}/install_mysqli.sh", capture=False)

# Step 11: Initialize the DB
run(f"docker exec -it db mariadb --password=hackme -e 'CREATE DATABASE breakTheBank'", capture=True)
run(f"cat /var/www/html/break_the_bank_database_schema.sql | docker exec -i db mariadb --password=hackme breakTheBank", capture=True)
run(f"cat /var/www/html/dummy_users/example_users.sql | docker exec -i db mariadb --password=hackme breakTheBank", capture=True)

print("Done.")
exit(0)