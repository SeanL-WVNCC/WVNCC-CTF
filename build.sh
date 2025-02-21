#!/bin/bash
docker compose up -d
docker exec -t html-web-1 /var/www/html/install_mysqli.sh