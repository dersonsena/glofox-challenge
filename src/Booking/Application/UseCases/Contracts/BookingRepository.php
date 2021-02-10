<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\Contracts;

use App\Booking\Domain\Member;
use App\Lesson\Domain\Lesson;
use DateTimeInterface;

interface BookingRepository
{
    public function haveVacancyAvailable(Lesson $lesson): bool;
    public function bookLesson(Member $member, Lesson $lesson, DateTimeInterface $data);
}
