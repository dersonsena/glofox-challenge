<?php

declare(strict_types=1);

namespace App\Lesson\Application\UseCases\Contracts;

use App\Lesson\Domain\Lesson;

interface LessonRepository
{
    public function createLesson(Lesson $lesson): string;
}
