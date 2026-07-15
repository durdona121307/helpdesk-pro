FROM php:8.3-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql zip


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY . .


RUN composer install --no-dev --optimize-autoloader


RUN npm install && npm run build


RUN php artisan storage:link || true


EXPOSE 10000


CMD CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000