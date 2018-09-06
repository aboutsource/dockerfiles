# Docker images for wordpress development

This image adds some development convenience to the basic aboutsource/php-fpm image

This images includes various versions of WP CLI to work with different WordPress versions. 
To specify a version set the environment variable `WP_CLI_VERSION` to the desired and available version.

## aboutsource/wordpress:5.6

PHP: 5.6.37
Composer: 1.7.2
WP CLI: 0.24.1, 0.25.0 (default), 1.5.0

## aboutsource/wordpress:7.0

PHP: 7.0.31
Composer: 1.7.2
WP CLI: 0.24.1, 0.25.0 (default), 1.5.0

## aboutsource/wordpress:*-debug

Includes Xdebug configured for use with remote debugging. 

Xdebug version: 2.5.0
IDE Key: `XDEBUG_IDE`
Remote port: 9001
