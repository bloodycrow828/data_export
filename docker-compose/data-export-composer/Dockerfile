FROM data-export-phpfpm

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN cp ./composer.phar /usr/bin/composer

RUN apt-get update && apt-get install -y --no-install-recommends \
    git-core

RUN rm -rf /var/lib/apt/lists/*

RUN composer config --global repo.packagist composer https://packagist.org
COPY ./composer.sh /root/composer.sh

ENTRYPOINT ["/root/composer.sh"]
