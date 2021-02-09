<?php

declare(strict_types=1);

namespace App\Shared\Infra\Adapters;

use App\Shared\Contracts\DatabaseConnection;
use MongoDB\BSON\ObjectId;
use MongoDB\Client as MongoDbClient;

final class MongoDBConnection implements DatabaseConnection
{
    private MongoDbClient $mongoDbClient;
    private string $databaseName;

    public function __construct(MongoDbClient $mongoDbClient, string $databaseName)
    {
        $this->mongoDbClient = $mongoDbClient;
        $this->databaseName = $databaseName;
    }

    public function insert(string $tableName, array $values): string
    {
        $collection = $this->mongoDbClient->selectCollection($this->databaseName, $tableName);

        /** @var ObjectId $objectId */
        $objectId = $collection->insertOne($values)->getInsertedId();

        return (string)$objectId;
    }
}
