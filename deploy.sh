#!/bin/bash

cd /var/www/html/eVALE

git init && git remote add origin git@gitlab.com:robertoadearruda/eVALE.git && git fetch origin && git checkout -f master && git pull origin master

git checkout -- . && rm -rf .git
chown -R 1000:1000 ../eVALE

composer install

php artisan migrate --seed
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan clear-compiled
php artisan key:generate

chmod -R 777 storage && chmod -R 777 bootstrap/cache