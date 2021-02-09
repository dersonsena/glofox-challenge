<?php

declare(strict_types=1);

namespace App\Lesson\Domain\Factory;

use App\Lesson\Domain\Lesson;
use DateTimeImmutable;

final class LessonFactory
{
    public static function create(array $values = []): Lesson
    {
        $entity = new Lesson();

        if (empty($values)) {
            return $entity;
        }

        if (isset($values['startDate'])) {
            $entity->setStartDate(new DateTimeImmutable($values['startDate']));
            unset($values['startDate']);
        }

        if (isset($values['endDate'])) {
            $entity->setEndDate(new DateTimeImmutable($values['endDate']));
            unset($values['endDate']);
        }

        $entity->fill($values);

        return $entity;
    }
}
