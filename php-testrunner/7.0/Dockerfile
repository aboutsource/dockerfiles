FROM php:7.0.27-cli

MAINTAINER support@aboutsource.net

ENV COMPOSER_PATH="/root/.composer" \
    COMPOSER_VERSION="1.6.3" \
    COMPOSER_SHA256_CHECKSUM="52cb7bbbaee720471e3b34c8ae6db53a38f0b759c06078a80080db739e4dcab6"

ENV PATH="$COMPOSER_PATH/vendor/bin:$PATH"

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

COPY ["composer.json", "$COMPOSER_PATH/composer.json"]

RUN composer install -d $COMPOSER_PATH --no-suggest --no-progress --no-interaction --no-dev \
     && mkdir -p /usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/

COPY ["rulesets/phpcs.xml", "/usr/local/src/aboutsource-wp-phpcs/aboutsource-WordPress/ruleset.xml"]
COPY ["rulesets/phpmd.xml", "/usr/local/src/aboutsource-phpmd-ruleset.xml"]
COPY ["src/BaseRunner.class.php", "/usr/local/src"]
COPY ["src/run-checks", "src/fix-issues", "/usr/local/bin/"]

RUN phpcs --config-set installed_paths \
    $COMPOSER_PATH/vendor/wp-coding-standards/wpcs,$COMPOSER_PATH/vendor/wimg/php-compatibility/,/usr/local/src/aboutsource-wp-phpcs \
    && phpcs --config-set colors 1 \
    && phpcs --config-set encoding utf-8
