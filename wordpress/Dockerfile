FROM alpine:3.15.4

# Install packages
RUN apk --no-cache add \
  php8 \
  php8-fpm \
  php8-mysqli \
  php8-json \
  php8-openssl \
  php8-curl \
  php8-zlib \
  php8-xml \
  php8-phar \
  php8-intl \
  php8-dom \
  php8-xmlreader \
  php8-xmlwriter \
  php8-exif \
  php8-fileinfo \
  php8-sodium \
  php8-gd \
  php8-simplexml \
  php8-ctype \
  php8-mbstring \
  php8-zip \
  php8-opcache \
  php8-iconv \
  php8-pecl-imagick \
  curl \
  bash \
  less

# Create symlink so programs depending on `php` still function
RUN ln -s /usr/bin/php8 /usr/bin/php

# Configure PHP-FPM
COPY php/fpm-pool.conf /etc/php8/php-fpm.d/zzz_custom.conf
COPY php/php.ini /etc/php8/conf.d/zzz_custom.ini

# wp-content volume
VOLUME /var/www/wp-content
WORKDIR /var/www/wp-content
RUN chown -R nobody.nobody /var/www

ENV WORDPRESS_VERSION 5.9.3
ENV WORDPRESS_SHA1 cab576e112c45806c474b3cbe0d1263a2a879adf

RUN mkdir -p /usr/src

# Upstream tarballs include ./wordpress/ so this gives us /usr/src/wordpress
RUN curl -o wordpress.tar.gz -SL https://wordpress.org/wordpress-${WORDPRESS_VERSION}.tar.gz \
	&& echo "$WORDPRESS_SHA1 *wordpress.tar.gz" | sha1sum -c - \
	&& tar -xzf wordpress.tar.gz -C /usr/src/ \
	&& rm wordpress.tar.gz \
	&& chown -R nobody.nobody /usr/src/wordpress

# Add WP CLI
RUN curl -o /usr/local/bin/data https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x /usr/local/bin/data

# Entrypoint to copy wp-content
COPY ./entrypoint.sh /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]

EXPOSE 9000

CMD [ "php-fpm8", "-F" ]

#HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1/wp-login.php
