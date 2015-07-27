#!/bin/bash
set -e

get_option () {
  local section=$1
  local option=$2
  local default=$3
  ret=$(my_print_defaults $section | grep '^--'${option}'=' | cut -d= -f2-)
  [ -z $ret ] && ret=$default
  echo $ret
}

# if run args starts with an option, we call bash with that options
if [ "${1:0:1}" = '-' ]; then
  set -- bash "$@"
fi

if [ "$1" = 'bash' ]; then
  clear
  echo Hello Worker!
else
  if [ ! -d "workdir" ]; then
    echo Please give me a volume /srv/workdir pointing to your gulp/bower workdir
    echo . . . use option: -v /path/to/workdir:/srv/workdir
    exit 1
  else
    cd workdir && echo Welcome to gulp/bower
    if [ ! -d "node_modules" ]; then
      echo Setup gulp in `pwd`..
      npm install
    fi
    if [ ! -d "bower_components" ]; then
      echo Setup bower in `pwd`..
      bower install --config.interactive=false
    fi
    if [ ! -d "dist" ]; then
      echo Precompile all in `pwd`..
      gulp
    fi
    if [ -z "$1" ]; then
      echo Starting watch process..
      gulp watch
    fi
  fi
fi

exec "$@"
