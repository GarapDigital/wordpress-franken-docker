FROM dunglas/frankenphp:php8.2

# Ensure Caddy config dir exists and bundle the Caddyfile into the image
# This avoids mounting a host path over a file (which can fail when host path is missing or a directory).
RUN mkdir -p /etc/caddy

RUN install-php-extensions \
    redis \
    imagick \
    intl \
    zip \
    mysqli \
    opcache

# Copy Caddy configuration into the image so the container has a valid /etc/caddy/Caddyfile
# If you still want to override this at runtime in development, you can mount a host Caddyfile
# to /etc/caddy/Caddyfile, but keeping a default inside the image prevents the mount error.
COPY Caddyfile /etc/caddy/Caddyfile

COPY php.ini /usr/local/etc/php/conf.d/custom.ini
