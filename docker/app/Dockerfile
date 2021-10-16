FROM php:8.0-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        oniguruma-dev \
        zlib-dev \
        libxml2-dev \
        postgresql-dev \
    && apk add --no-cache \
        git \
        shadow \
        supervisor \
        postgresql-client \
        libpng-dev \
        libjpeg-turbo-dev \
        libzip-dev \
    && pecl install \
        pcov \
        redis \
    && docker-php-ext-enable \
        pcov \
        redis \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install \
        mbstring \
        bcmath \
        pcntl \
        pdo \
        pdo_pgsql \
        pgsql \
        gd \
        zip \
        xml \
        tokenizer \
    && curl -s https://getcomposer.org/installer | \
        php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps

# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

ENV COMPOSER_MEMORY_LIMIT=-1

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

USER www-data
