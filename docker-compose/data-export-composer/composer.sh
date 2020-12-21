#!/bin/bash

composer self-update

composer config -g repo.packagist composer https://packagist.org
composer config -g github-protocols https ssh

if [ "$APP_ENV" = "DEV" ] ; \
    then  \
        echo "This is ${APP_ENV}" && \
        composer update -d /web_root/ --prefer-dist ; \
    else \
        composer update -d /web_root/ --classmap-authoritative --prefer-dist --no-dev ; \
    fi
