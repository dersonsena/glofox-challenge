<?php

declare(strict_types=1);

namespace App\Lesson\Domain;

use App\Shared\Domain\Entity;
use App\Shared\Domain\ValueObject\DateRange;
use DateTimeInterface;

final class Lesson extends Entity
{
    protected string $name;
    protected DateTimeInterface $startDate;
    protected DateTimeInterface $endDate;
    protected int $capacity;

    public function __construct(string $name, DateRange $dateRange, int $capacity)
    {
        $this->name = $name;
        $this->startDate = $dateRange->getStartDate();
        $this->endDate = $dateRange->getEndDate();
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }
}
