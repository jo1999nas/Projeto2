# O ARQUIVO COMPLETO E CORRIGIDO
# Usamos a imagem base do PHP 8.3 com FPM e Alpine para ser mais leve
FROM php:8.3-fpm-alpine

# Argumentos para o ID do usuário e do grupo, que virão do docker-compose
ARG UID
ARG GID

# Instala dependências persistentes (RUNTIME)
RUN apk add --no-cache git zip unzip postgresql-libs libzip nodejs npm

# Instala dependências de build, compila as extensões e remove as dependências de build
RUN apk add --no-cache --virtual .build-deps \
        build-base \
        autoconf \
        postgresql-dev \
        libzip-dev \
        linux-headers \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql bcmath sockets \
    && pecl install redis zip \
    && docker-php-ext-enable redis zip \
    && apk del .build-deps

# --- A SOLUÇÃO PARA PERMISSÕES ---
# Cria um grupo e um usuário com os mesmos IDs do seu usuário do computador
RUN addgroup -g $GID --system laravel && \
    adduser -u $UID -G laravel --system --shell /bin/sh laravel

# Define o usuário 'laravel' como o padrão para todos os comandos
USER laravel

# Instala o Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho padrão
WORKDIR /var/www/html