import random
import unicodedata

# Quick script for generating some random users.

# I scraped these from a scam site
with open("usernames.txt", "r", encoding="charmap") as username_file:
    usernames = username_file.readlines()

# I'm not including rockyou in the repo due to size, install yourself
with open("/usr/share/wordlists/rockyou.txt", "r", encoding="charmap") as rockyou:
    passwords = rockyou.readlines()

# From: https://1000randomnames.com/
with open("names.txt", "r", encoding="charmap") as names_file:
    names = names_file.readlines()

domains = ["yahoo.com", "hotmail.com", "gmail.com", "outlook.com", "rocketmail.com"]

# Genrate 1000 users; we can do no more unless we find more names/usernames
for index in range(1000):
    username = unicodedata.normalize("NFKC", usernames[index][:-1])
    password = unicodedata.normalize("NFKC", random.sample(passwords, 1)[0][:-1])
    firstname = unicodedata.normalize("NFKC", names[index][:-1].split(" ")[0])
    lastname = unicodedata.normalize("NFKC", names[index][:-1].split(" ")[1])
    domain = random.sample(domains, 1)[0]
    email = f"{firstname.lower()}_{lastname.lower()}@{domain}"
    print(f'INSERT INTO users (username, password, firstName, lastName, email, isAdmin) VALUES ("{username}", "{password}", "{firstname}", "{lastname}", "{email}", False);')