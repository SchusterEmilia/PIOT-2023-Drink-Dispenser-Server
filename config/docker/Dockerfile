FROM debian:bookworm as base

ARG DEBIAN_FRONTEND=noninteractive

ARG USERNAME=dev
ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    wget \
    less \
    gnupg \
    apt-transport-https \
    lsb-release \
    unzip \
    ca-certificates \
    sudo

# Create the user
RUN groupadd --gid $GID $USERNAME \
    && useradd --uid $UID --gid $GID -m $USERNAME \
    && echo $USERNAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME \
    && chmod 0440 /etc/sudoers.d/$USERNAME

RUN curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg \
    && sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' \
    && apt-get update

#PHP packages
RUN apt-get install -y --no-install-recommends \
    php8.2-apcu \
    php8.2-cli \
    php8.2-fpm \
    php8.2-xdebug \
    php8.2-pcov \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-intl \
    php8.2-pdo \
    php8.2-opcache \
    php8.2-curl \
    php8.2-dom \
    nginx \
    ssl-cert \
    git

# cleanup
RUN rm -rf /var/lib/apt/lists/*

#composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#PHP config
COPY config/php/custom.ini /etc/php/8.2/cli/conf.d/custom.ini
COPY config/php/custom.ini /etc/php/8.2/fpm/conf.d/custom.ini

#COPY php/xdebug.ini /etc/php/8.2/cli/conf.d/99-xdebug.ini
COPY config/php/xdebug.ini /etc/php/8.2/fpm/conf.d/99-xdebug.ini

RUN rm /etc/php/8.2/fpm/pool.d/www.conf
COPY config/php/pool.conf /etc/php/8.2/fpm/pool.d/pool.conf

COPY config/nginx/drinkdispenser.com /etc/nginx/sites-enabled/drinkdispenser.com
RUN rm /etc/nginx/sites-enabled/default

RUN usermod -aG $USERNAME www-data


USER $USERNAME
WORKDIR /code

CMD composer install && composer migrate && sudo nginx && sudo php-fpm8.2 && tail -f /dev/null
