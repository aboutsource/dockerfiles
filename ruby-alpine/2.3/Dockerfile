FROM ruby:2.3-alpine

RUN apk update && \
    apk add git build-base && \
    rm -rf /var/cache/apk/* \

RUN mkdir /srv/app
WORKDIR /srv/app
