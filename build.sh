#!/bin/bash
# This script deploys Break the Bank application via docker compose.
# 1: Install Linux, Windows subsystem for Linux should suffice.
# 2: Install docker Compose V2.
# 3: Place this file (and the entire repo) at /var/www/html.
# 4: Stop any web server that happens to be runnning on port 80.
# 5: Run this script.
docker compose up -d
docker exec -t html-web-1 /var/www/html/install_mysqli.sh