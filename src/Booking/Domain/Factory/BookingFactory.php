<?php

declare(strict_types=1);

namespace App\Booking\Domain\Factory;

use App\Booking\Domain\Booking;
use App\Booking\Domain\Member;
use App\Lesson\Domain\Lesson;
use DateTimeImmutable;

final class BookingFactory
{
    private function __construct()
    {
    }

    public static function create(Member $member, Lesson $lesson, string $date): Booking
    {
        return new Booking($member, $lesson, new DateTimeImmutable($date));
    }
}
