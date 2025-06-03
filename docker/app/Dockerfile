# Base step
FROM php:8.4-fpm AS base

# Base: Install MySQLi
RUN docker-php-ext-install pdo pdo_mysql mysqli && \
	docker-php-ext-enable mysqli

# Base: Install the zip extension
RUN apt-get update && \
	apt-get install -y zlib1g-dev libzip-dev && \
	docker-php-ext-configure zip && \
	docker-php-ext-install zip

# Base: Set working directory
WORKDIR /var/www/html

# Base: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Base: Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - && \
	apt-get update && \
	apt-get install -y nodejs

# Base: Install NPM
RUN npm install npm -g

# Build step
FROM base AS build

# Copy application files
COPY ./app /var/www/html

# Install composer dependencies
RUN composer update

# Install NPM dependencies
RUN npm install\
	&& npm run build