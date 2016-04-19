FROM aboutsource/php-fpm:5.6

MAINTAINER support@aboutsource.net

COPY SHA384SUMS .
RUN curl -sL https://getcomposer.org/installer > composer-setup.php
RUN sha384sum -c SHA384SUMS
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer --version=1.0.1
RUN rm SHA384SUMS

RUN apt-get update && apt-get install -y git && apt-get autoremove && rm -rf /var/lib/apt/lists/*

RUN composer global require "wp-coding-standards/wpcs:dev-master" "wimg/php-compatibility:dev-master" "simplyadmire/composer-plugins:@dev" "phpmd/phpmd:@stable"
ENV COMPOSER_PATH /root/.composer/vendor
ENV PATH $COMPOSER_PATH/bin:$PATH

RUN phpcs --config-set installed_paths $COMPOSER_PATH/wp-coding-standards/wpcs,/usr/local/src/aboutsource-wp-phpcs

# The PHPCompatibility package needs to be copied manually...autoloading does not work
RUN cp -R $COMPOSER_PATH/wimg/php-compatibility $COMPOSER_PATH/squizlabs/php_codesniffer/CodeSniffer/Standards/PHPCompatibility

RUN mkdir -p /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/
COPY ruleset.xml /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/
COPY run-checks /usr/local/bin/
