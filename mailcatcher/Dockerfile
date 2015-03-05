FROM ruby:2.2
MAINTAINER support@aboutsource.net

RUN gem install mailcatcher --no-ri --no-rdoc

EXPOSE 1080 25

CMD ["mailcatcher", "--foreground", "--ip", "0.0.0.0", "--smtp-port", "25"]
