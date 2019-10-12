<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Capsule\Manager;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        Manager::class => function (ContainerInterface $c) {
            $capsule = new Manager;
            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => 'db',
                'database' => 'test_db',
                'username' => 'admin',
                'password' => 'admin',
                'charset' => 'utf8',
                'collation' => 'utf8_general_ci',
                'prefix' => '',
            ]);

            $capsule->setEventDispatcher(new Dispatcher(new Container));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return $capsule;
        },
    ]);
};
