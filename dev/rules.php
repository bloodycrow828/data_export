#!/usr/bin/env php
<?php

$dirs = [
    '/web_root/apps/common/runtime',
    '/web_root/apps/converter/runtime',
    '/web_root/apps/converter/runtime/cache',
    '/web_root/apps/converter/runtime/logs',
];

array_map(
    function ($dir) {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        chown($dir, 'www-data');
        chgrp($dir, 'www-data');
        chmod($dir, 0777);
    },
    $dirs
);
