FROM php:5-cli

MAINTAINER support@aboutsource.net

ENV COMPOSER_PATH="/root/.composer/vendor" \
    COMPOSER_VERSION="1.1.3"

ENV PATH="$COMPOSER_PATH/bin:$PATH"

WORKDIR /var/www/html

# git and unzip are needed for composer
RUN apt-get update \
    && apt-get install -y --no-install-recommends git-core unzip \
    && apt-get autoremove -y \
    && apt-get purge -y \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sL -o /usr/local/bin/composer "https://getcomposer.org/download/$COMPOSER_VERSION/composer.phar" \
    && chmod +x /usr/local/bin/composer

RUN composer global require \
                    "wp-coding-standards/wpcs:dev-master" \
                    "wimg/php-compatibility:dev-master" \
                    "simplyadmire/composer-plugins:@dev" \
                    "phpmd/phpmd:@stable" \

    # The PHPCompatibility package needs to be copied manually...autoloading does not work
    && cp -R  \
       $COMPOSER_PATH/wimg/php-compatibility \
       $COMPOSER_PATH/squizlabs/php_codesniffer/CodeSniffer/Standards/PHPCompatibility \
       && mkdir -p /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/

COPY ["ruleset.xml", "/usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/"]
COPY ["BaseRunner.class.php", "/usr/local/src"]
COPY ["run-checks", "fix-issues", "/usr/local/bin/"]

RUN phpcs --config-set installed_paths \
    $COMPOSER_PATH/wp-coding-standards/wpcs,/usr/local/src/aboutsource-wp-phpcs \
    && phpcs --config-set colors 1 \
    && phpcs --config-set encoding utf-8

