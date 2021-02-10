<?php

declare(strict_types=1);

namespace App\Booking\Infra\Repositories;

use App\Booking\Application\UseCases\Contracts\MemberRepository as MemberRepositoryInterface;
use App\Booking\Domain\Factory\MemberFactory;
use App\Booking\Domain\Member;

final class MemberRepository implements MemberRepositoryInterface
{
    public function findMemberById(string $id): Member
    {
        return MemberFactory::create('Kilderson Sena', 'MALE');
    }
}
