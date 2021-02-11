<?php

namespace Tests\Unit\Lesson\Domain;

use App\Lesson\Domain\Lesson;
use App\Shared\Domain\ValueObjects\DateRange;
use App\Shared\Exceptions\AppValidationException;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class LessonTest extends TestCase
{
    private function getDateRangeMock()
    {
        $dateRangeMock = $this->getMockBuilder(DateRange::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dateRangeMock->method('getStartDate')
            ->willReturn(new DateTimeImmutable('2021-01-10'));

        $dateRangeMock->method('getEndDate')
            ->willReturn(new DateTimeImmutable('2021-01-15'));

        return $dateRangeMock;
    }

    public function testIfDateIsWithinOfRange()
    {
        $lesson = new Lesson('any-name', $this->getDateRangeMock(), 1);

        $this->assertTrue($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-10')));
        $this->assertTrue($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-11')));
        $this->assertTrue($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-12')));
        $this->assertTrue($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-13')));
        $this->assertTrue($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-14')));
        $this->assertTrue($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-15')));
    }

    public function testIfDateIsOutOfRange()
    {
        $lesson = new Lesson('any-name', $this->getDateRangeMock(), 1);

        $this->assertFalse($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-08')));
        $this->assertFalse($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-09')));
        $this->assertFalse($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-16')));
        $this->assertFalse($lesson->dateIsWithinRange(new DateTimeImmutable('2021-01-17')));
        $this->assertFalse($lesson->dateIsWithinRange(new DateTimeImmutable('2021-05-01')));
        $this->assertFalse($lesson->dateIsWithinRange(new DateTimeImmutable('2021-06-22')));
    }

    public function testIfExceptionIsThrownIfCapacityIsZero()
    {
        $this->expectException(AppValidationException::class);
        new Lesson('any-name', $this->getDateRangeMock(), 0);
    }
}
