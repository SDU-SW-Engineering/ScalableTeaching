# The following command pulls the latest changes from the default branch.
# It's based on the custom ssh remote defined in `/root/.ssh/config`.
# It also points to a public/private key, that is used as a deploy key in the ST repo, to avoid putting the responsibility on 1 person to maintain the key.
git pull git@github.com-st:SDU-SW-Engineering/ScalableTeaching.git


php artisan down --refresh=15 # Put app into maintenance mode

# Build the frontend assets
npm run production # Build and minify the frontend assets

# Laravel related commands
php artisan optimize # Optimize config, events, routes, and views.
php artisan migrate # Migrate the db

# Ensure correct permissions are set.

sudo chown -R "$USER:www-data" . # Change ownership of the project to the current user and the webserver group (makes it easier to work with the files)
sudo find . -type f -exec chmod 644 {} \; # Set file permissions to 644 so you can read and write but others can only read
sudo find . -type d -exec chmod 755 {} \; # Set directory permissions to 755 so you can read, write, and execute but others can only read and execute

# Now assign the webserver to own the storage and cache directories
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

php artisan up # Bring the app out of maintenance mode

