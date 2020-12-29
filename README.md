# data_export
Тестовое задание для компании briskly
- https://git.briskly.online/pub/hr/php

Установить обратный прокси traefik.

```bash

git clone https://gogs.mt-pc.ru/danjudex/traefik
cd traefik
./up.sh
```

для разработки нужно выполнить

```bash
make init-dev
make install
```

После этого настроить /etc/hosts на машине разработчика
добавить

```
127.0.0.1 briskly-export.loc
```

После этого выполнить
```bash
make build-up
```

