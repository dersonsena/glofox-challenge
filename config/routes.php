<?php

/** @var \Slim\App $app */

use App\Lesson\Presentation\Web\LessonCreateController;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->group('/', function (RouteCollectorProxyInterface $group) {
    $group->post('classes', LessonCreateController::class);
});
