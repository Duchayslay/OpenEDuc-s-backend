# Dùng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài các extension Laravel cần
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd



# Copy mã nguồn Laravel vào container
COPY . /var/www/html

# Chỉ định thư mục làm việc
WORKDIR /var/www/html

# Cài Laravel dependency
RUN composer install --no-dev --optimize-autoloader

# Phân quyền
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Enable mod_rewrite
RUN a2enmod rewrite

# Apache config để Laravel xử lý route
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
