FROM ruby:2.2
MAINTAINER support@aboutsource.net

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
      make \
      gcc \
      g++ \
      patch \
      libsqlite3-dev && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get clean

RUN gem install mailcatcher --no-ri --no-rdoc

EXPOSE 1080 1025

CMD ["mailcatcher", "--foreground", "--ip", "0.0.0.0"]
