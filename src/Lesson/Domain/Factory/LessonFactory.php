<?php

declare(strict_types=1);

namespace App\Lesson\Domain\Factory;

use App\Lesson\Domain\Lesson;
use App\Shared\Domain\ValueObject\DateRange;

final class LessonFactory
{
    public static function create(string $name, string $startDate, string $endDate, int $capacity = 1): Lesson
    {
        return new Lesson($name, new DateRange($startDate, $endDate), $capacity);
    }
}
