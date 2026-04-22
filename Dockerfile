# Usar a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar extensões necessárias para o banco de dados
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar o mod_rewrite do Apache
RUN a2enmod rewrite

# Reiniciar o Apache para aplicar as mudanças
RUN service apache2 restart
