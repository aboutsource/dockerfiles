# Docker image for php-testrunner

    PHP-Version: 5.6
    Composer: 1.0.2

Includes:

* phpcs
* phpmd
* rulesets for WordPress, PHP-Compatibility
* Custom about:source WordPress ruleset

## Usage

    run-checks <file> <folder> <file> ...

This will run `phpcs` and `phpmd` with settings defined by this image.

You can of course still run `phpcs` and `phpmd` manually.
