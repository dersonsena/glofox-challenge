<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use App\Shared\Exceptions\AppValidationException;
use DateTimeImmutable;

final class DateRange
{
    private DateTimeImmutable $startDate;
    private DateTimeImmutable $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $startDateObject = DateTimeImmutable::createFromFormat('Y-m-d', $startDate);
        $endDateObject = DateTimeImmutable::createFromFormat('Y-m-d', $endDate);

        if ($startDateObject === false) {
            throw new AppValidationException(['start_date' => 'invalid-date'], 'Start Date format is invalid.');
        }

        if ($endDateObject === false) {
            throw new AppValidationException(['end_date' => 'invalid-date'], 'End Date format is invalid.');
        }

        if ($startDateObject > $endDateObject) {
            throw new AppValidationException(
                ['start_date' => "invalid-date"],
                'Start Date cannot be later than the End Date'
            );
        }

        $this->startDate = $startDateObject;
        $this->endDate = $endDateObject;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}
