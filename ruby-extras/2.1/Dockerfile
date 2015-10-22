FROM ruby:2.1

MAINTAINER benjamin.meichsner@aboutsource.net

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
      mysql-client \
      postgresql-client \
      nodejs \
      xvfb && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get clean
