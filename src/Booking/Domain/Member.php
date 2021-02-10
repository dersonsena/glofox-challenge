<?php

declare(strict_types=1);

namespace App\Booking\Domain;

use App\Shared\Domain\Entity;
use App\Shared\Domain\ValueObjects\Gender;

final class Member extends Entity
{
    protected string $name;
    protected Gender $gender;

    public function __construct(string $name, Gender $gender)
    {
        $this->name = $name;
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }
}
