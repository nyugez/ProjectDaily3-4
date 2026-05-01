FROM dunglas/frankenphp:php8.3-bookworm

RUN install-php-extensions gd zip xml mbstring ctype fileinfo curl dom filter hash openssl pcre pdo session tokenizer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction
RUN npm install && npm run build
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache && chmod -R a+rw storage
RUN php artisan config:cache && php artisan event:cache && php artisan route:cache && php artisan view:cache

CMD ["/start-container.sh"]
