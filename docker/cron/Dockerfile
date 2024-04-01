FROM php:8.3-cli

RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git curl libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev && docker-php-ext-install pdo_mysql

RUN apt-get update && apt-get install -y cron

CMD ["cron", "-f"]
