<?php

declare(strict_types=1);

namespace App\Booking\Infra\Repositories;

use App\Booking\Application\UseCases\Contracts\BookingRepository as BookingRepositoryInterface;
use App\Booking\Domain\Member;
use App\Lesson\Domain\Lesson;
use App\Shared\Contracts\DatabaseConnection;
use App\Shared\Exceptions\AppValidationException;
use DateTimeInterface;

final class BookingRepository implements BookingRepositoryInterface
{
    private DatabaseConnection $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function haveVacancyAvailable(Lesson $lesson): bool
    {
        $bookings = $this->db->findAll('bookings', ['lesson.id' => $lesson->getId()]);
        $count = count($bookings);

        if ($count === 0) {
            return true;
        }

        if ($count >= $lesson->getCapacity()) {
            return false;
        }

        return true;
    }

    public function alreadyBooked(Member $member, Lesson $lesson): bool
    {
        $bookings = $this->db->findAll('bookings', [
            'lesson.id' => $lesson->getId(),
            'member.id' => $member->getId()
        ]);

        if (count($bookings) === 0) {
            return false;
        }

        return true;
    }

    public function bookLesson(Member $member, Lesson $lesson, DateTimeInterface $date): string
    {
        if (!$lesson->dateIsWithinRange($date)) {
            throw new AppValidationException(
                ['date' => 'out-of-range'],
                'The date informed is out of range the class.'
            );
        }

        if ($this->alreadyBooked($member, $lesson)) {
            throw new AppValidationException(
                ['member_id' => 'already-enrolled'],
                'This member is already enrolled in this class'
            );
        }

        if (!$this->haveVacancyAvailable($lesson)) {
            throw new AppValidationException(
                ['capacity' => 'sold-out'],
                'Vacancies sold out for this class'
            );
        }

        return $this->db->insert('bookings', [
            'member' => $member->toArray(),
            'lesson' => $lesson->toArray(),
            'date' => $date->format(DateTimeInterface::ATOM)
        ]);
    }
}
