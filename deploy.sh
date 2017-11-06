#!/bin/bash

cd /var/www/html/eVALE

git init && git remote add origin git@gitlab.com:robertoadearruda/eVALE.git && git fetch origin && git checkout -f master && git pull origin master

chown -R 1000:1000 ../eVALE && chmod -R 777 storage && chmod -R 777 bootstrap/cache
git checkout -- . && rm -rf .git

composer install

php artisan migrate --seed
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan clear-compiled
php artisan key:generate