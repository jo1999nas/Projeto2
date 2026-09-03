FROM php:8.3-fpm-alpine

ARG UID=1000
ARG GID=1000

# Dependências de runtime necessárias
RUN apk add --no-cache git zip unzip postgresql-libs libzip nodejs npm

# Instalação de dependências de build, extensões nativas do PHP e limpeza das dependências de build
RUN apk add --no-cache --virtual .build-deps \
        build-base \
        linux-headers \
        postgresql-dev \
        libzip-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql bcmath sockets zip \
    && apk del .build-deps

# Criação de grupo e usuário não-root com UID/GID correspondentes
RUN addgroup -g $GID --system laravel && \
    adduser -u $UID -G laravel --system --shell /bin/sh laravel

# Instala o Composer globalmente a partir da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia e dá permissão ao script de entrypoint
COPY .docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

USER laravel
WORKDIR /var/www/html

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]