# Docker image for php-testrunner

    PHP-Version: 7.0.27
    Composer: 1.6.3

Includes:

* phpcs
* phpmd
* rulesets for WordPress, PHP-Compatibility
* Custom about:source WordPress ruleset

## Usage

    run-checks <file> <folder> <file> ...

This will run `phpcs` and `phpmd` with settings defined by this image.

    !!! Paths without a leading slash will be prefixed with application/wp-content !!!

You can of course still run `phpcs` and `phpmd` manually.

### Automatic fixing

    fix-issues <file> <folder> <file>...
    
This will run `phpcbf` with the settings defined by this image.  
  
    !!! Paths without a leading slash will be prefixed with application/wp-content !!!
