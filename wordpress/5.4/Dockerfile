FROM aboutsource/php-fpm:5.4

MAINTAINER support@aboutsource.net

RUN curl -s -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
  chmod +x /usr/local/bin/wp

RUN apt-get update && apt-get install less
