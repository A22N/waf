FROM php:7.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html/
COPY ./src .

# Create the necessary directories
RUN mkdir -p /var/www/html/upload

# Set ownership and permissions
RUN chown -R root:www-data /var/www/html
RUN chmod 750 /var/www/html
RUN chmod -R 777 /var/www/html/upload
RUN find /var/www/html -type f -exec chmod 640 {} \;
RUN find /var/www/html -type d -exec chmod 750 {} \;

# Optionally, you can remove the sticky bit line if not needed
# RUN chmod +t -R /var/www/html/

# Install ModSecurity
RUN apt-get update && \
    apt-get install -y libapache2-mod-security2

# Install OWASP CRS
RUN mkdir -p /usr/share/modsecurity-crs && \
    cd /usr/share/modsecurity-crs && \
    git clone https://github.com/coreruleset/coreruleset.git && \
    cd coreruleset && \
    git checkout main && \
    cp -r * /usr/share/modsecurity-crs && \
    cd .. && \
    rm -rf coreruleset

# After copying the configuration files
RUN rm -f /usr/share/modsecurity-crs/rules/REQUEST-934-APPLICATION-ATTACK-NODEJS.conf

# Enable ModSecurity module and configuration
RUN a2enmod security2

# Copy ModSecurity configuration
COPY modsecurity.conf /etc/apache2/mods-enabled/security2.conf
COPY crs-setup.conf /usr/share/modsecurity-crs/crs-setup.conf