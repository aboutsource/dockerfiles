FROM aboutsource/php-fpm:7.0

MAINTAINER support@aboutsource.net

RUN curl -Ls -o /usr/local/bin/wp https://github.com/wp-cli/wp-cli/releases/download/v0.22.0/wp-cli-0.22.0.phar && \
  chmod +x /usr/local/bin/wp

RUN apt-get update && apt-get install less && rm -rf /var/lib/apt/lists/*
