#!/bin/bash
# Change access rights for the Laravel folders
# in order to make Laravel able to access
# cache and logs folder.
chgrp -R www-data showcase/storage showcase/bootstrap/cache && \
    chown -R www-data showcase/storage && \
    chown -R www-data showcase/bootstrap/cache && \
    chmod -R ug+rwx showcase/storage showcase/bootstrap/cache

ls -la

# Create log file for Laravel and give it write access
# www-data is a standard apache user that must have an
# access to the folder structure
touch showcase/storage/logs/laravel.log && \
     chmod 775 showcase/storage/logs/laravel.log && \
     chown -R www-data showcase/storage && \
     chown -R www-data showcase/public/tmp

echo "Done..."
