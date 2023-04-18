FROM php:8.2-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY ./docker/cronjob/crontab /etc/crontabs/root

#CMD ["crond", "-f"]

COPY ../../entrypoint.sh /opt/bin/entrypoint.sh

RUN chmod +x /opt/bin/entrypoint.sh

ENTRYPOINT ["/opt/bin/entrypoint.sh"]