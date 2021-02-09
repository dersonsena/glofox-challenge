<?php

declare(strict_types=1);

namespace App\Lesson\Application\UseCases\Create;

use App\Shared\Application\Enum\ValidationErrorEnum;
use App\Shared\Contracts\ValidatorTool;

final class CreateValidator
{
    private ValidatorTool $validator;
    private array $errors = [];

    public function __construct(ValidatorTool $validator)
    {
        $this->validator = $validator;
    }

    public function validate(InputBoundary $input): array
    {
        $this->validateName($input);
        $this->validateStartDate($input);
        $this->validateEndDate($input);
        $this->validateCapacity($input);

        return $this->errors;
    }

    private function validateName(InputBoundary $input): void
    {
        if ($this->validator->validate($input->getName(), ValidatorTool::IS_NULL)) {
            $this->errors['name'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getName(), ValidatorTool::IS_EMPTY)) {
            $this->errors['name'][] = ValidationErrorEnum::EMPTY;
        }
    }

    private function validateStartDate(InputBoundary $input): void
    {
        if ($this->validator->validate($input->getStartDate(), ValidatorTool::IS_NULL)) {
            $this->errors['start_date'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getStartDate(), ValidatorTool::IS_EMPTY)) {
            $this->errors['start_date'][] = ValidationErrorEnum::EMPTY;
        }

        if (!$this->validator->validate($input->getStartDate(), ValidatorTool::IS_DATE)) {
            $this->errors['start_date'][] = ValidationErrorEnum::INVALID_DATE;
        }
    }

    private function validateEndDate(InputBoundary $input)
    {
        if ($this->validator->validate($input->getEndDate(), ValidatorTool::IS_NULL)) {
            $this->errors['end_date'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getEndDate(), ValidatorTool::IS_EMPTY)) {
            $this->errors['end_date'][] = ValidationErrorEnum::EMPTY;
        }

        if (!$this->validator->validate($input->getEndDate(), ValidatorTool::IS_DATE)) {
            $this->errors['end_date'][] = ValidationErrorEnum::INVALID_DATE;
        }
    }

    private function validateCapacity(InputBoundary $input)
    {
        if ($this->validator->validate($input->getCapacity(), ValidatorTool::IS_NULL)) {
            $this->errors['capacity'][] = ValidationErrorEnum::REQUIRED;
        }

        if ($this->validator->validate($input->getCapacity(), ValidatorTool::IS_EMPTY)) {
            $this->errors['capacity'][] = ValidationErrorEnum::EMPTY;
        }

        if (!$this->validator->validate($input->getCapacity(), ValidatorTool::IS_INT)) {
            $this->errors['capacity'][] = ValidationErrorEnum::NOT_INTEGER;
        }
    }
}
