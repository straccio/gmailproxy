# A Gmail IMAP Proxy
# VERSION 1.0

FROM ubuntu:14.04
MAINTAINER Ziheng Zhou <shyujikou@icloud.com>

RUN apt-get update
RUN apt-get -y upgrade
RUN apt-get -y install php5-fpm nginx supervisor stunnel4 netsed

# Config nginx, ssl, auth.php
ADD ./nginx.conf /etc/nginx/nginx.conf
RUN mkdir /etc/nginx/ssl
ADD ./ssl.cert /etc/nginx/ssl/ssl.cert
ADD ./ssl.key /etc/nginx/ssl/ssl.key
ADD ./auth.php /usr/share/nginx/html/auth.php

# Config stunnel4
ADD ./stunnel.conf /etc/stunnel/stunnel.conf
RUN sed -i -e "s/ENABLED=0/ENABLED=1/g" /etc/default/stunnel4

# Config supervisor
ADD ./services.conf /etc/supervisor/conf.d/services.conf

EXPOSE 993

CMD ["/usr/bin/supervisord"]
