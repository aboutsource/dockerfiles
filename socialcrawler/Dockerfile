FROM debian:wheezy
MAINTAINER support@aboutsource.net

ADD http://downloads.voxelbrain.com/socialcrawler/develop/current/linux_amd64/socialcrawler /usr/bin/socialcrawler

RUN chmod +x /usr/bin/socialcrawler

CMD ["/usr/bin/socialcrawler", "--help"]
