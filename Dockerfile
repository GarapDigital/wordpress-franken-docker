FROM dunglas/frankenphp:php8.2

RUN install-php-extensions \
    redis \
    imagick \
    intl \
    zip \
    mysqli \
    opcache

COPY php.ini /usr/local/etc/php/conf.d/custom.ini
