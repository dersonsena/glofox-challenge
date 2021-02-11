<?php

namespace Tests\Unit\Lesson\Application\UseCases\Create;

use App\Lesson\Application\UseCases\Contracts\LessonRepository;
use App\Lesson\Application\UseCases\Create\Create;
use App\Lesson\Application\UseCases\Create\CreateValidator;
use App\Lesson\Application\UseCases\Create\InputBoundary;
use App\Shared\Exceptions\AppValidationException;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    private function getLessonRepository()
    {
        $mock = $this->getMockBuilder(LessonRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('createLesson')
            ->willReturn('any-id');

        return $mock;
    }

    private function getCreateValidator(array $returnValue = [])
    {
        $mock = $this->getMockBuilder(CreateValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('validate')
            ->willReturn($returnValue);

        return $mock;
    }

    private function getInputBoundery()
    {
        $mock = $this->getMockBuilder(InputBoundary::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('getName')
            ->willReturn('any-name');

        $mock->method('getStartDate')
            ->willReturn('2021-01-01');

        $mock->method('getEndDate')
            ->willReturn('2021-01-05');

        $mock->method('getCapacity')
            ->willReturn(1);

        return $mock;
    }

    public function testIfSuccessOnCreateLesson()
    {
        $useCase = new Create($this->getLessonRepository(), $this->getCreateValidator());
        $output = $useCase->handle($this->getInputBoundery());

        $this->assertNotEmpty($output->getId());
        $this->assertNotNull($output->getId());
        $this->assertSame('any-id', $output->getId());
    }

    public function testIfValidateFailOnProvideInvalidData()
    {
        $this->expectException(AppValidationException::class);
        $this->expectDeprecationMessage('An error occurred while creating the class.');

        $useCase = new Create(
            $this->getLessonRepository(),
            $this->getCreateValidator(['any-field' => 'any-message'])
        );

        $useCase->handle($this->getInputBoundery());
    }
}
