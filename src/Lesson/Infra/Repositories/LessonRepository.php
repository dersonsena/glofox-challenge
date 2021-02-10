<?php

declare(strict_types=1);

namespace App\Lesson\Infra\Repositories;

use App\Lesson\Application\UseCases\Contracts\LessonRepository as LessonRepositoryAlias;
use App\Lesson\Domain\Factory\LessonFactory;
use App\Lesson\Domain\Lesson;
use App\Shared\Contracts\DatabaseConnection;

final class LessonRepository implements LessonRepositoryAlias
{
    private DatabaseConnection $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function createLesson(Lesson $lesson): string
    {
        return $this->db->insert('lessons', $lesson->toArray());
    }

    public function findLessonById(string $id): Lesson
    {
        return LessonFactory::create('xpto', '2021-01-01', '2021-01-10', 10);
    }
}
