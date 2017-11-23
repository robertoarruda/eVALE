#!/bin/bash

cd /var/www/html/eVALE

git init && git remote add origin git@github.com:evalesoftware/eVALE.git && git fetch origin && git checkout -f master && git pull origin master

git checkout -- . && rm -rf .git

cp .env.example .env

composer install

php artisan migrate --seed
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan clear-compiled
php artisan key:generate

chown -R 1000:1000 public && chmod -R 777 storage && chmod -R 777 bootstrap/cache