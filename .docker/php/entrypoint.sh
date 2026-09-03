#!/bin/sh
set -e

# Garante a existência do arquivo .env em src/
if [ ! -f /var/www/html/.env ] && [ -f /var/www/html/.env.example ]; then
    echo "Creating .env from .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Instala as dependências via Composer se a pasta vendor não existir
if [ ! -d /var/www/html/vendor ]; then
    echo "Vendor directory not found. Running composer install..."
    composer install --no-progress --no-interaction
fi

# Gera a chave da aplicação se não estiver configurada
if [ -f /var/www/html/.env ] && ! grep -q "^APP_KEY=base64:" /var/www/html/.env 2>/dev/null; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# Instala as dependências JS (NPM) se node_modules não existir
if [ ! -d /var/www/html/node_modules ]; then
    echo "node_modules not found. Running npm install..."
    npm install --no-progress --no-audit
fi

# Compila os assets do Vite se o manifesto não existir
if [ ! -f /var/www/html/public/build/manifest.json ]; then
    echo "Vite manifest not found. Building assets with npm run build..."
    npm run build
fi

# Executa o comando principal do container (ex: php-fpm)
exec "$@"
