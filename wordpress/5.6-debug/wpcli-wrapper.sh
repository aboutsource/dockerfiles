#!/bin/bash

WP_CLI_PATH="/usr/local/lib/wp-cli/wp-$WP_CLI_VERSION.phar"
if [ ! -f "$WP_CLI_PATH" ]; then
  >&2 echo "WP CLI in version $WP_CLI_VERSION not available!"
  exit 1
else
  php $WP_CLI_PATH "$@"
fi
