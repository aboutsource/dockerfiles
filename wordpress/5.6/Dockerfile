FROM aboutsource/php-fpm:5.6

MAINTAINER support@aboutsource.net

RUN curl -Ls -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/04f348aa0893ec85100773b7b5b7846c777574ac/phar/wp-cli.phar && \
  chmod +x /usr/local/bin/wp

RUN apt-get update && apt-get install less
