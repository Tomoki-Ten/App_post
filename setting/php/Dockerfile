FROM php:7.4-fpm-buster

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
RUN apt-get update && \
    apt-get -y install \
    #libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    nodejs \
    npm && \
    apt-get clean
RUN docker-php-ext-configure gd \
    #--with-freetype \
    --with-jpeg &&\
    docker-php-ext-install -j$(nproc) gd \
    intl \
    zip \
    pdo_mysql \
    bcmath
RUN npm install -g n && \
    n stable
COPY ./php.ini /usr/local/etc/php/php.ini
WORKDIR /work
# 上、開発用
#
# 以下２行、 ECR への PUSH 用COPY、開発時不要
# app ディレクトリを ./php 下に置いてから実行すること
#COPY --chown=www-data:www-data ./app /work
#RUN chmod -R 755 /work/storage
