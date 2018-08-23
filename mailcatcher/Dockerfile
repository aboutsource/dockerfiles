FROM ruby:2.2

LABEL maintainer="support@aboutsource.net"

ENV MAILCATCHER_VERSION=0.6.1

RUN gem install mailcatcher --version $MAILCATCHER_VERSION --no-ri --no-rdoc

EXPOSE 1080 1025

CMD ["mailcatcher", "--foreground", "--ip", "0.0.0.0"]
