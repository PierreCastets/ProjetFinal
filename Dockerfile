#image officielle de php
FROM php:7.4-fpm-alpine

#Emplacement
WORKDIR /var/www/html/

#Installation de pré-requis
RUN apk --no-cache update && apk --no-cache add bash git zip unzip
RUN docker-php-ext-install pdo_mysql

#Installation de composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

#Copie du code source
COPY . .

#installation des dépendances
RUN composer install
RUN composer dump-autoload
Run composer update

#lancement du serveur symfony
#RUN /bin/bash -c 'symfony server:start'

