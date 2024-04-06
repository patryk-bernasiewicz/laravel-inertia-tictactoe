#!/bin/bash
set -e

echo "Deploying..."

(php artisan down) || true

git pull origin master

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
npm install

php artisan clear-compiled
php artisan optimize

npm run build

php artisan migrate --force
php artisan up

echo "Deployment finished!"