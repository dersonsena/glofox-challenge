<?php

use App\Lesson\Application\UseCases\Contracts\LessonRepository as LessonRepositoryInterface;
use App\Lesson\Infra\Repositories\LessonRepository;
use App\Shared\Contracts\DatabaseConnection;
use App\Shared\Contracts\ValidatorTool;
use App\Shared\Infra\Adapters\MongoDBConnection;
use App\Shared\Infra\Adapters\RespectValidation;
use DI\Container;
use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    // Repositories
    LessonRepositoryInterface::class => DI\autowire(LessonRepository::class),

    // Adapter
    ValidatorTool::class => DI\autowire(RespectValidation::class),
    DatabaseConnection::class => DI\get('mongodb')
]);

$container = $containerBuilder->build();

$container->set('config', function () {
    return require __DIR__ . DS . 'config.php';
});

$container->set('mongodb', function (Container $container) {
    $conf = $container->get('config')['mongodb'];

    $mongoDbClient = new MongoDB\Client(
        "mongodb://{$conf['username']}:{$conf['password']}@{$conf['host']}:{$conf['port']}/?retryWrites=true&w=majority"
    );

    return new MongoDBConnection($mongoDbClient, $conf['dbname']);
});
