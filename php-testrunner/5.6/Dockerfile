FROM php:5.6.33-cli

MAINTAINER support@aboutsource.net

ENV COMPOSER_PATH="/root/.composer/vendor" \
    COMPOSER_VERSION="1.6.3" \
    COMPOSER_SHA256_CHECKSUM="52cb7bbbaee720471e3b34c8ae6db53a38f0b759c06078a80080db739e4dcab6"

ENV PATH="$COMPOSER_PATH/bin:$PATH"

WORKDIR /var/www/html

# git and unzip are needed for composer, patch by phpcbf
RUN apt-get update \
    && apt-get install -y --no-install-recommends git-core unzip patch \
    && apt-get autoremove -y \
    && apt-get purge -y \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sL -o /usr/local/bin/composer "https://getcomposer.org/download/$COMPOSER_VERSION/composer.phar" \
    && echo "$COMPOSER_SHA256_CHECKSUM /usr/local/bin/composer" > /usr/local/bin/composer-$COMPOSER_VERSION.phar.sha256sum \
    && sha256sum -c /usr/local/bin/composer-$COMPOSER_VERSION.phar.sha256sum \
    && rm /usr/local/bin/composer-$COMPOSER_VERSION.phar.sha256sum \
    && chmod +x /usr/local/bin/composer

RUN composer global require --no-suggest --no-progress --no-interaction \
                    "wp-coding-standards/wpcs:dev-master" \
                    "wimg/php-compatibility:dev-master" \
                    "simplyadmire/composer-plugins:@dev" \
                    "phpmd/phpmd:@stable" \

    # The PHPCompatibility package needs to be copied manually...autoloading does not work
    && cp -R  \
       $COMPOSER_PATH/wimg/php-compatibility/PHPCompatibility \
       $COMPOSER_PATH/squizlabs/php_codesniffer/src/Standards/PHPCompatibility \
       && mkdir -p /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/

COPY ["rulesets/phpcs.xml", "/usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/ruleset.xml"]
COPY ["rulesets/phpmd.xml", "/usr/local/src/aboutsource-phpmd-ruleset.xml"]
COPY ["src/BaseRunner.class.php", "/usr/local/src"]
COPY ["src/run-checks", "src/fix-issues", "/usr/local/bin/"]

RUN phpcs --config-set installed_paths \
    $COMPOSER_PATH/wp-coding-standards/wpcs,/usr/local/src/aboutsource-wp-phpcs \
    && phpcs --config-set colors 1 \
    && phpcs --config-set encoding utf-8

