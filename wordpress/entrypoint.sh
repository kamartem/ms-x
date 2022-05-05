#!/bin/bash

# terminate on errors
set -e

# Check if volume is empty
if [ ! "$(ls -A "/var/www/wp-content" 2>/dev/null)" ]; then
    echo 'Setting up data-content volume'
    # Copy data-content from Wordpress src to volume
    cp -r /usr/src/wordpress/wp-content /var/www/
    chown -R nobody.nobody /var/www

    # Generate secrets
    curl -s https://api.wordpress.org/secret-key/1.1/salt/ >> /usr/src/wordpress/wp-secrets.php
fi

#php-fpm8 -F
exec "$@"
