<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\BookLesson;

use App\Shared\Helpers\DTO;

final class OutputBoundary extends DTO
{
    protected array $member;
    protected string $date;

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
}
