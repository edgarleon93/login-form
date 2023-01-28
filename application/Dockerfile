FROM php:8.0.20-apache

ENV NODE_VERSION=16.13.0

## Copy source code
COPY ./source /var/www/html

## Install git and unzip
RUN apt-get update && apt-get install -y --no-install-recommends git unzip curl && \
    rm -rf /var/lib/apt/lists/*

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version

## Install composer
RUN curl --silent --show-error https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

## Enable PHP and Apache modules
RUN docker-php-ext-install pdo pdo_mysql mysqli gettext
RUN a2enmod rewrite headers ssl
