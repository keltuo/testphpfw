# Pull base image
FROM ubuntu:16.04

# Install common tools
RUN apt-get update
RUN apt-get install -y wget curl vim git unzip bzip2 software-properties-common apache2-utils wrk

# Set working directory
WORKDIR /var/www/html


# Install supervisor
RUN apt-get install -y supervisor
RUN mkdir -p /var/log/supervisor
ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf

#------------- Container Config ---------------------------------------------------------------

# Expose port 80
EXPOSE 80

# Set supervisor to manage container processes
ENTRYPOINT ["/usr/bin/supervisord"]

