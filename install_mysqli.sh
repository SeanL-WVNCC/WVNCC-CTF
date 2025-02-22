#!/bin/bash
# Run the following from inside the database container
bash -c "docker-php-ext-install mysqli ; apachectl restart"
