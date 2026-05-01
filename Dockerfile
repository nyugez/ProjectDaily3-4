FROM dunglas/frankenphp:php8.3-bookworm

RUN apt-get update && apt-get install -y curl unzip zip && \
    curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

RUN install-php-extensions gd zip xml mbstring ctype fileinfo curl dom filter hash openssl pcre pdo pdo_mysql session tokenizer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction
RUN npm install && npm run build
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache && chmod -R a+rw storage

EXPOSE 8080

CMD php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && frankenphp run --config /app/Caddyfile
