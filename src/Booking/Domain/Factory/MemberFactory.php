<?php

declare(strict_types=1);

namespace App\Booking\Domain\Factory;

use App\Booking\Domain\Member;
use App\Shared\Domain\ValueObjects\Gender;

final class MemberFactory
{
    private function __construct()
    {
    }

    public static function create(string $name, string $gender): Member
    {
        return new Member($name, new Gender($gender));
    }
}
