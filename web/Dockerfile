# Start from the base PHP image
FROM php:7.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html/

# Copy source code
COPY ./src .

# Set permissions
RUN mkdir -p /var/www/html/upload && \
    chown -R root:www-data /var/www/html && \
    chmod 750 /var/www/html && \
    chmod -R 777 /var/www/html/upload && \
    chown www-data:www-data /var/www/html/upload/blog && \
    chmod 755 /var/www/html/upload/blog && \
    chown www-data:www-data /var/www/html/upload/user/ && \
    chmod 755 /var/www/html/upload/user/ && \
    find /var/www/html -type f -exec chmod 640 {} \; && \
    find /var/www/html -type d -exec chmod 750 {} \;

# Install ModSecurity
RUN apt-get update && \
    apt-get install -y libapache2-mod-security2 git

# Install OWASP CRS
RUN mkdir -p /usr/share/modsecurity-crs && \
    cd /usr/share/modsecurity-crs && \
    git clone https://github.com/coreruleset/coreruleset.git && \
    cd coreruleset && \
    git checkout main && \
    cp -r * /usr/share/modsecurity-crs && \
    cd .. && \
    rm -rf coreruleset

# Enable ModSecurity
RUN a2enmod security2

# Copy ModSecurity configuration files
COPY modsecurity.conf /etc/apache2/mods-enabled/security2.conf
COPY crs-setup.conf /usr/share/modsecurity-crs/crs-setup.conf

# Xóa quy tắc trùng lặp
RUN rm -f /usr/share/modsecurity-crs/rules/REQUEST-934-APPLICATION-ATTACK-NODEJS.conf

# Copy custom rules
COPY custom_rules.conf /usr/share/modsecurity-crs/rules/custom_rules.conf

# Update ModSecurity to include custom rules
RUN echo 'Include /usr/share/modsecurity-crs/rules/custom_rules.conf' >> /etc/apache2/mods-enabled/security2.conf

# Expose port 80
EXPOSE 80
