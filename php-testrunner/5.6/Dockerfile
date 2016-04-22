FROM aboutsource/php-fpm:5.6

MAINTAINER support@aboutsource.net

COPY composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

ENV COMPOSER_PATH /root/.composer/vendor
ENV PATH $COMPOSER_PATH/bin:$PATH

# git is needed for composer
RUN apt-get update && apt-get install -y git && apt-get autoremove && rm -rf /var/lib/apt/lists/*

RUN composer global require \
                    "wp-coding-standards/wpcs:dev-master" \
                    "wimg/php-compatibility:dev-master" \
                    "simplyadmire/composer-plugins:@dev" \
                    "phpmd/phpmd:@stable"

# The PHPCompatibility package needs to be copied manually...autoloading does not work
RUN cp -R  \
    $COMPOSER_PATH/wimg/php-compatibility \
    $COMPOSER_PATH/squizlabs/php_codesniffer/CodeSniffer/Standards/PHPCompatibility

RUN mkdir -p /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/
COPY ruleset.xml /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/
COPY run-checks /usr/local/bin/

RUN phpcs \
    --config-set installed_paths \
    $COMPOSER_PATH/wp-coding-standards/wpcs,/usr/local/src/aboutsource-wp-phpcs
