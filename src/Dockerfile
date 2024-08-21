# Use Ubuntu as the base image
FROM ubuntu:22.04

# Set noninteractive mode and configure time zone
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Asia/Ho_Chi_Minh

# Install Apache, PHP, MySQLi, and other dependencies
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-mysql wget nano apt-transport-https gnupg2 curl git && \
    echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" | tee -a /etc/apt/sources.list.d/elastic-7.x.list && \
    apt-get update && \
    apt-get install -y libpcap0.8

# Install Filebeat and Packetbeat
RUN apt-get install -y filebeat packetbeat

# Install ModSecurity
RUN apt-get install -y libapache2-mod-security2

# Install OWASP CRS
RUN mkdir -p /usr/share/modsecurity-crs && \
    git clone https://github.com/coreruleset/coreruleset.git /usr/share/modsecurity-crs && \
    cd /usr/share/modsecurity-crs && \
    git checkout main && \
    cp -r * /usr/share/modsecurity-crs && \
    rm -rf /usr/share/modsecurity-crs/coreruleset

# Remove unnecessary rules
RUN rm -f /usr/share/modsecurity-crs/rules/REQUEST-934-APPLICATION-ATTACK-NODEJS.conf

# Set working directory
WORKDIR /var/www/html/
RUN rm -rf index.html
COPY ./WEB .

# Enable ModSecurity module and configuration
RUN a2enmod security2

# Copy ModSecurity configuration
COPY modsecurity.conf /etc/apache2/mods-enabled/security2.conf
COPY crs-setup.conf /usr/share/modsecurity-crs/crs-setup.conf

# Change permissions
RUN chown -R www-data:www-data /var/www/html/images/
RUN chmod -R 777 /var/www/html/images/

# Expose port 80 to the outside world
EXPOSE 80

# Start Apache server
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
