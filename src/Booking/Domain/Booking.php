<?php

declare(strict_types=1);

namespace App\Booking\Domain;

use App\Lesson\Domain\Lesson;
use App\Shared\Domain\Entity;
use DateTimeImmutable;

final class Booking extends Entity
{
    protected Member $member;
    protected Lesson $lesson;
    protected DateTimeImmutable $date;

    public function __construct(Member $member, Lesson $lesson, DateTimeImmutable $date)
    {
        $this->member = $member;
        $this->date = $date;
        $this->lesson = $lesson;
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }

    /**
     * @param Member $member
     * @return Booking
     */
    public function setMember(Member $member): Booking
    {
        $this->member = $member;
        return $this;
    }

    /**
     * @return Lesson
     */
    public function getLesson(): Lesson
    {
        return $this->lesson;
    }

    /**
     * @param Lesson $lesson
     * @return Booking
     */
    public function setLesson(Lesson $lesson): Booking
    {
        $this->lesson = $lesson;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param DateTimeImmutable $date
     * @return Booking
     */
    public function setDate(DateTimeImmutable $date): Booking
    {
        $this->date = $date;
        return $this;
    }
}
