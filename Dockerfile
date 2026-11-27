FROM php:8.5-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends $PHPIZE_DEPS git \
    unzip \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_pgsql intl zip gd \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG APP_VERSAO=dev
ENV APP_VERSAO=${APP_VERSAO}

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm", "-F"]