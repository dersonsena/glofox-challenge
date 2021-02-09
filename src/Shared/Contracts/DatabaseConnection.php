<?php

declare(strict_types=1);

namespace App\Shared\Contracts;

interface DatabaseConnection
{
    public function insert(string $tableName, array $values): string;
}
