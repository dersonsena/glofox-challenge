<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\Contracts;

use App\Booking\Domain\Member;

interface MemberRepository
{
    public function findMemberById(string $id): Member;
}
