<?php

declare(strict_types=1);

namespace App\Booking\Infra\Repositories;

use App\Booking\Application\UseCases\Contracts\MemberRepository as MemberRepositoryInterface;
use App\Booking\Domain\Factory\MemberFactory;
use App\Booking\Domain\Member;
use App\Shared\Contracts\DatabaseConnection;

final class MemberRepository implements MemberRepositoryInterface
{
    private DatabaseConnection $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function findMemberById(string $id): Member
    {
        $data = $this->db->findById('members', $id);

        return MemberFactory::create($data['name'], $data['gender']);
    }
}
