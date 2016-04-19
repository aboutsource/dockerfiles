# Docker image for php-testrunner

    PHP-Version: 5.6
    Composer: 1.0.1

Includes:

* phpcs
* phpmd
* rulesets for WordPress, PHP-Compatibility
* PSR2-R
* Custom about:source WordPress ruleset

## Usage

    run-checks <file> <folder> <file> ...

This will run `phpcs` and `phpmd` with settings defined by this image.

You can of course still run `phpcs` and `phpmd` manually.
