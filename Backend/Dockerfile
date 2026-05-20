FROM php:8.2-fpm-alpine

# Instalar dependências do sistema e extensões necessárias para o Laravel e PostgreSQL
RUN apk add --no-cache \
    postgresql-dev \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    oniguruma-dev \
    zip \
    unzip \
    git \
    nginx \
    curl \
    supervisor

# Instalar extensões PHP exigidas pelo ecossistema Laravel
RUN docker-php-ext-install pdo pdo_pgsql zip gd bcmath ctype fileinfo mbstring xml

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir a pasta de trabalho
WORKDIR /var/www

# Copiar o código do Laravel
COPY . /var/www

# Instalar as dependências do Laravel (adicionado --ignore-platform-reqs por segurança)
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Dar permissões corretas para as pastas do Laravel gravarem logs e cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar o ficheiro de configuração do Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Expor a porta 80
EXPOSE 80

# Iniciar o PHP-FPM e o Nginx em simultâneo
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
