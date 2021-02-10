<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\BookLesson;

use App\Shared\Application\Enum\ValidationErrorEnum;
use App\Shared\Contracts\ValidatorTool;

final class BookLessonValidator
{
    private ValidatorTool $validator;
    private array $errors = [];

    public function __construct(ValidatorTool $validator)
    {
        $this->validator = $validator;
    }

    public function validate(InputBoundary $input): array
    {
        $this->validateMemberId($input);
        $this->validateLessonId($input);
        $this->validateDate($input);

        return $this->errors;
    }

    private function validateMemberId(InputBoundary $input): void
    {
        if ($this->validator->validate($input->getMemberId(), ValidatorTool::IS_NULL)) {
            $this->errors['member_id'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getMemberId(), ValidatorTool::IS_EMPTY)) {
            $this->errors['member_id'][] = ValidationErrorEnum::EMPTY;
        }
    }

    private function validateLessonId(InputBoundary $input): void
    {
        if ($this->validator->validate($input->getLessonId(), ValidatorTool::IS_NULL)) {
            $this->errors['lesson_id'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getLessonId(), ValidatorTool::IS_EMPTY)) {
            $this->errors['lesson_id'][] = ValidationErrorEnum::EMPTY;
        }
    }

    private function validateDate(InputBoundary $input): void
    {
        if ($this->validator->validate($input->getDate(), ValidatorTool::IS_NULL)) {
            $this->errors['date'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getDate(), ValidatorTool::IS_EMPTY)) {
            $this->errors['date'][] = ValidationErrorEnum::EMPTY;
        }

        if (!$this->validator->validate($input->getDate(), ValidatorTool::IS_DATE)) {
            $this->errors['date'][] = ValidationErrorEnum::INVALID_DATE;
        }
    }
}
