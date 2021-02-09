<?php

declare(strict_types=1);

namespace App\Lesson\Application\UseCases\Create;

use App\Lesson\Application\UseCases\Contracts\LessonRepository;
use App\Lesson\Domain\Factory\LessonFactory;
use App\Shared\Domain\ValueObject\DateRange;
use App\Shared\Exceptions\AppValidationException;

final class Create
{
    private LessonRepository $repository;
    private CreateValidator $validator;

    public function __construct(
        LessonRepository $repository,
        CreateValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $errors = $this->validator->validate($input);

        if (count($errors) > 0) {
            throw new AppValidationException($errors, 'An error occurred while creating the class.');
        }

        $lesson = LessonFactory::create(
            $input->getName(),
            $input->getStartDate(),
            $input->getEndDate(),
            $input->getCapacity()
        );

        $lessonId = $this->repository->createLesson($lesson);

        return OutputBoundary::build(['id' => $lessonId]);
    }
}
