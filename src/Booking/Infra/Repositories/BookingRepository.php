<?php

declare(strict_types=1);

namespace App\Booking\Infra\Repositories;

use App\Booking\Application\UseCases\Contracts\BookingRepository as BookingRepositoryInterface;
use App\Booking\Domain\Member;
use App\Lesson\Domain\Lesson;
use DateTimeInterface;

final class BookingRepository implements BookingRepositoryInterface
{
    public function haveVacancyAvailable(Lesson $lesson): bool
    {
        return true;
    }

    public function bookLesson(Member $member, Lesson $lesson, DateTimeInterface $data)
    {
    }
}
