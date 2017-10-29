#!/bin/bash

cd /var/www/html/eVALE

git checkout -- .
git checkout master
git pull origin master

chmod -R 777 storage && chmod -R 777 bootstrap/cache

composer install

php artisan migrate --seed
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan clear-compiled
php artisan key:generate