<?php

declare(strict_types=1);

namespace App\Lesson\Application\UseCases\Create;

use App\Shared\Helpers\DTO;

final class InputBoundary extends DTO
{
    protected ?string $name = '';
    protected ?string $startDate = '';
    protected ?string $endDate = '';
    protected ?int $capacity = 0;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @return int
     */
    public function getCapacity(): ?int
    {
        return $this->capacity;
    }
}
