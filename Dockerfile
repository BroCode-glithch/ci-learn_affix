# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Install required extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable mod_rewrite for CodeIgniter
RUN a2enmod rewrite

# Copy the project files into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
