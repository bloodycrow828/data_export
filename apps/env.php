<?php

require_once(__DIR__ . '/helpers.php');

/**
 * Load application environment from .env file
 */
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__, 1));
$dotenv->load();
