<?php

use App\Booking\Presentation\Web\BookingLessonController;
use App\Lesson\Presentation\Web\LessonCreateController;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */

$app->group('/api/v1', function (RouteCollectorProxyInterface $group) {
    $group->post('/classes', LessonCreateController::class);
    $group->post('/bookings', BookingLessonController::class);
});
