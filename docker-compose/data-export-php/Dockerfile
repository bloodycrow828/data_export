FROM php:7.4-fpm

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./conf.d /usr/local/etc/php/conf.d
COPY ./conf.d-dev /usr/local/etc/php/conf.d-dev

RUN apt-get update && apt-get install -y --no-install-recommends \
    libmcrypt-dev \
    libgd-dev \
    libonig-dev \
    libpq-dev \
    zlib1g-dev \
    libzip-dev

RUN docker-php-ext-install mbstring pcntl zip

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

ARG APP_ENV
RUN if [ "$APP_ENV" = "DEV" ] ; \
    then  \
        echo "This is DEV" && \
        # В среде разработки влючаем xdebug и выключаем opcache
        cp -r /usr/local/etc/php/conf.d-dev/* /usr/local/etc/php/conf.d && \
        pecl install xdebug && docker-php-ext-enable xdebug && \
        rm /usr/local/etc/php/conf.d/opcache.ini ; \
    else \
        echo "This is PROD" && \
        # для аккуратности подчистим на продакшн среде dev конфиги
        rm -r /usr/local/etc/php/conf.d-dev/ ; \
    fi

RUN rm -rf /var/lib/apt/lists/*

COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /web_root

