<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\BookLesson;

use App\Shared\Helpers\DTO;

final class OutputBoundary extends DTO
{
    protected string $bookingId;
    protected array $member;
    protected array $lesson;
    protected string $date;

    /**
     * @return string
     */
    public function getBookingId(): string
    {
        return $this->bookingId;
    }

    /**
     * @return array
     */
    public function getMember(): array
    {
        return $this->member;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return array
     */
    public function getLesson(): array
    {
        return $this->lesson;
    }
}
