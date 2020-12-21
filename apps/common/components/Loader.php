<?php

namespace data_export\common\components;

use Dotenv\Dotenv;
use Yii;
use yii\base\Application;
use yii\helpers\ArrayHelper;


class Loader
{
    /**
     * @param string $appName
     *
     * @return Application
     * @throws \yii\base\InvalidConfigException
     */
    public function createApplication(string $appName): Application
    {
        $commonPath = COMMON_APP_DIR;
        $appPath = APPS_DIR . DIRECTORY_SEPARATOR . $appName;

        // Переменные окружения
        $this->loadEnvironment();

        // Конфигурация приложения
        $commonConfigPath = $commonPath . DIRECTORY_SEPARATOR . 'config';
        $configPath = $appPath . DIRECTORY_SEPARATOR . 'config';
        $commonBaseConfig = $this->loadConfig($commonConfigPath, 'base');
        $commonEnvConfig = $this->loadConfig($commonConfigPath, YII_ENV);
        $baseAppConfig = $this->loadConfig($configPath, 'base');
        $envAppConfig = $this->loadConfig($configPath, YII_ENV);
        $config = ArrayHelper::merge($commonBaseConfig, $commonEnvConfig, $baseAppConfig, $envAppConfig);

        return Yii::createObject($config);
    }

    /**
     * Загружает переменные окружения
     * @param string $file Имя файла
     * @return Dotenv|null
     */
    private function loadEnvironment($file = '.env'): ?Dotenv
    {
        $envPath = dirname(__DIR__, 3);
        $envFile = $envPath . DIRECTORY_SEPARATOR . $file;

        if (file_exists($envFile)) {
            $env = Dotenv::createImmutable($envPath, $file);
            $env->load();
            return $env;
        }
        return null;
    }

    /**
     * Загружает конфигурацию
     * @param string $path Каталог
     * @param string $file Имя файла (можно без расширения .php)
     * @return array
     */
    private function loadConfig(string $path, string $file): array
    {
        $configFile = $path . DIRECTORY_SEPARATOR . $file;
        if (!file_exists($configFile)) {
            $configFile .= '.php';
        }

            return require $configFile;
    }
}
