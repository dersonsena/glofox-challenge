<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\BookLesson;

use App\Shared\Helpers\DTO;

final class InputBoundary extends DTO
{
    protected ?string $memberId = '';
    protected ?string $lessonId = '';
    protected ?string $date = '';

    /**
     * @return string
     */
    public function getMemberId(): ?string
    {
        return $this->memberId;
    }

    /**
     * @return string
     */
    public function getLessonId(): ?string
    {
        return $this->lessonId;
    }

    /**
     * @return string
     */
    public function getDate(): ?string
    {
        return $this->date;
    }
}
