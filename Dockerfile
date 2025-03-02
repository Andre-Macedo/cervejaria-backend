FROM php:8.3.11-fpm

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
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Configurar extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath opcache

# Instalar Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Instalar Node.js 18.x e npm mais recente
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos de dependências primeiro para cache
COPY package.json package-lock.json* ./

# Instalar dependências do npm como root
RUN npm install --force

# Copiar o restante da aplicação
COPY . .

# Build dos assets
RUN npm run build

# Ajustar permissões
RUN chown -R www-data:www-data /var/www/html

USER www-data

# Porta e comando de inicialização
EXPOSE 9000
CMD ["php-fpm"]
