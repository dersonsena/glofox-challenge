<?php

declare(strict_types=1);

namespace App\Shared\Contracts;

interface DatabaseConnection
{
    public function insert(string $tableName, array $values): string;
    public function findById(string $tableName, string $id): array;
    public function findAll(string $tableName, array $filters, array $options = []): array;
}
