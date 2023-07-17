# Use the latest PHP-FPM base image
FROM php:fpm

# Set working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files into the container
COPY . .

# Install Laravel dependencies
RUN composer install

# Generate key for Laravel
RUN php artisan key:generate

# Set permissions (if needed)
# RUN chown -R www-data:www-data /var/www/html/storage

# Expose the port for PHP-FPM
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
