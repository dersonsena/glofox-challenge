<?php

namespace Tests\Unit\Lesson\Application\UseCases\Create;

use App\Lesson\Application\UseCases\Create\CreateValidator;
use App\Lesson\Application\UseCases\Create\InputBoundary;
use App\Shared\Application\Enum\ValidationErrorEnum;
use App\Shared\Contracts\ValidatorTool;
use PHPUnit\Framework\TestCase;

class CreateValidatorTest extends TestCase
{
    private function getValidatorTool(bool $returnValue = false)
    {
        $mock = $this->getMockBuilder(ValidatorTool::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('validate')
            ->willReturn($returnValue);

        return $mock;
    }

    public function testIfValidationWhenNameIsValid()
    {
        $input = $this->getMockBuilder(InputBoundary::class)
            ->disableOriginalConstructor()
            ->getMock();

        $input->method('getName')
            ->willReturn('any-name');

        $validator = new CreateValidator($this->getValidatorTool());
        $errors = $validator->validate($input);

        $this->assertFalse(array_key_exists('name', $errors));
    }

    public function testIfValidationWhenNameIsInvalid()
    {
        $input = $this->getMockBuilder(InputBoundary::class)
            ->disableOriginalConstructor()
            ->getMock();

        $input->method('getName')
            ->willReturn('');

        $validator = new CreateValidator($this->getValidatorTool(true));
        $errors = $validator->validate($input);

        $this->assertTrue(array_key_exists('name', $errors));
        $this->assertCount(2, $errors['name']);
        $this->assertSame(ValidationErrorEnum::REQUIRED, $errors['name'][0]);
        $this->assertSame(ValidationErrorEnum::EMPTY, $errors['name'][1]);
    }
}
