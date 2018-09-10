FROM quay.io/aboutsource/php-fpm:5.6

LABEL maintainer="support@aboutsource.net"

RUN apt-get update && apt-get install -y --no-install-recommends less git openssh-client unzip && rm -rf /var/lib/apt/lists/*

ENV WP_CLI_VERSION 0.25.0
ENV COMPOSER_VERSION 1.7.2

RUN mkdir -p /usr/local/lib/wp-cli && \
  curl -Ls -o /usr/local/lib/wp-cli/wp-0.24.1.phar https://github.com/wp-cli/wp-cli/releases/download/v0.24.1/wp-cli-0.24.1.phar && \
  curl -Ls -o /usr/local/lib/wp-cli/wp-0.25.0.phar https://github.com/wp-cli/wp-cli/releases/download/v0.25.0/wp-cli-0.25.0.phar && \
  curl -Ls -o /usr/local/lib/wp-cli/wp-1.5.0.phar https://github.com/wp-cli/wp-cli/releases/download/v1.5.0/wp-cli-1.5.0.phar

COPY wpcli-wrapper.sh /usr/local/bin/wp

RUN chmod +x /usr/local/bin/wp

RUN curl -Ls -o /usr/local/bin/composer https://getcomposer.org/download/$COMPOSER_VERSION/composer.phar && \
  chmod +x /usr/local/bin/composer

COPY SHA512SUMS /tmp/SHA512SUMS

RUN sha512sum --check --strict /tmp/SHA512SUMS
