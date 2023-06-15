# Imagem base do PHP
FROM php:8.0-fpm

# Instalar dependências do sistema operacional
RUN apt-get update && apt-get install -y \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto
COPY . .

# Instalar as dependências do Composer
RUN composer install --no-interaction --optimize-autoloader

# Definir as permissões adequadas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar o arquivo de exemplo de configuração do ambiente
COPY .env.example .env

# Gerar a chave da aplicação
RUN php artisan key:generate
RUN php artisan jwt:secret


# Executar os comandos de migração
RUN php artisan migrate 
RUN php artisan db:seed

# Expor a porta 9000 para conexões do servidor web
EXPOSE 9000

# Comando para iniciar o servidor PHP-FPM
CMD ["php-fpm"]