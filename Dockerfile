FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install

COPY .env.example .env
RUN php artisan key:generate

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 9000

CMD ["php-fpm"]
