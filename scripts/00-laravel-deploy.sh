#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo

echo "generating application key..."
php artisan key:generate --show

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

