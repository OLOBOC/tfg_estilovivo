FROM php:8.1-cli

# instalar dependencias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 libsqlite3-dev

# instalar composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# copiar el proyecto
WORKDIR /app
COPY . .

# instalar dependencias
RUN composer install

# generar clave de aplicacion
RUN php artisan key:generate

# exponer puerto
EXPOSE 8000

# ejecutar laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
