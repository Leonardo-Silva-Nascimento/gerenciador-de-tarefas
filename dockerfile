# Use a imagem oficial do PHP com o Apache
FROM php:7.4-apache

# Instale as dependências do PHP necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Configurar o servidor Apache
RUN a2enmod rewrite

# Defina o diretório de trabalho no container
WORKDIR /var/www/html

# Copie os arquivos do projeto Laravel para o container
COPY . .

# Instale as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Execute o Composer para instalar as dependências do Laravel
RUN composer install

# Defina as permissões adequadas para o Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Defina as variáveis de ambiente
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Exponha a porta do Apache
EXPOSE 80
