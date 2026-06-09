FROM php:8.2-fpm-alpine

# Install runtime dependencies
RUN apk add --no-cache \
    msmtp perl wget procps shadow \
    libzip libpng libjpeg-turbo libwebp freetype icu \
    mariadb-dev nginx

# Install build dependencies, compile PHP extensions, lalu hapus
RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd mysqli pdo pdo_mysql intl bcmath opcache exif zip && \
    apk del build-essentials && \
    rm -rf /usr/src/php*

# Setup nginx
RUN mkdir -p /run/nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Install Composer
RUN wget -q http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Copy source & install dependencies
WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction && \
    chown -R www-data: /app

# Fix warning JSON args
CMD ["sh", "/app/docker/startup.sh"]