FROM php:8.2-fpm

# Diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libxpm-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    bash \
    fcgiwrap \
    libmcrypt-dev \
    libonig-dev \
    libicu-dev \
    libpq-dev \
    net-tools \
    nano \
    procps \
    && rm -rf /var/lib/apt/lists/*

# Configurar extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath opcache intl

RUN git config --global --add safe.directory /var/www/html

# Instalar Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Instalar Node.js 18.x e npm mais recente
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Copiar arquivos de dependências primeiro para cache
COPY package.json package-lock.json* ./

# Instalar dependências do npm
RUN npm install

# Copiar o restante da aplicação
COPY . /var/www/html

RUN composer install

# Build dos assets
RUN npm run build

# Update PHP-FPM listen address to listen on all interfaces
RUN sed -i 's/^listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/^listen = 9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/zz-docker.conf

# Mudar proprietário do diretorio
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www

USER www-data

# Porta e comando de inicialização
EXPOSE 9000
CMD ["php-fpm"]
