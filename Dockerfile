FROM php:8.2-fpm-alpine AS base

RUN apk add --no-cache \
    bash curl git zip unzip \
    libzip-dev libpng-dev icu-dev libxml2-dev \
    linux-headers oniguruma-dev rabbitmq-c \
    && docker-php-ext-install pdo pdo_mysql zip intl sockets pcntl

# Composer deps
FROM base AS composer-deps

COPY . /app
WORKDIR /app

# ⚠️ Копируем всё до установки зависимостей
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && composer install --no-dev --prefer-dist --optimize-autoloader

# Final build
FROM base

WORKDIR /var/www/html
COPY . .
COPY --from=composer-deps /app/vendor ./vendor

RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]
