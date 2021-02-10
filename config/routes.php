<?php

/** @var \Slim\App $app */

use App\Booking\Presentation\Web\BookingLessonController;
use App\Lesson\Presentation\Web\LessonCreateController;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->group('/', function (RouteCollectorProxyInterface $group) {
    $group->post('classes', LessonCreateController::class);
    $group->post('bookings', BookingLessonController::class);
});
