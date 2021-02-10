<?php

declare(strict_types=1);

namespace App\Shared\Infra\Adapters;

use App\Shared\Contracts\DatabaseConnection;
use App\Shared\Exceptions\AppValidationException;
use MongoDB\BSON\ObjectId;
use MongoDB\Client as MongoDbClient;
use MongoDB\Model\BSONDocument;

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

    public function findById(string $tableName, string $id): array
    {
        $collection = $this->mongoDbClient->selectCollection($this->databaseName, $tableName);

        /** @var BSONDocument $document */
        $document = $collection->findOne(['_id' => new ObjectId($id)]);

        if (!$document) {
            throw new AppValidationException(['_id' => 'not-found'], "Document not found with id '{$id}'");
        }

        return iterator_to_array($document);
    }

    public function findAll(string $tableName, array $filters, array $options = []): array
    {
        $collection = $this->mongoDbClient->selectCollection($this->databaseName, $tableName);

        $data = [];
        $documents = $collection->find($filters, $options)->toArray();

        if (count($documents) === 0) {
            return [];
        }

        /** @var BSONDocument $document */
        foreach ($documents as $i => $document) {
            $document = $document->getArrayCopy();

            foreach ($document as $key => $value) {
                if ($value instanceof ObjectId) {
                    $data[$i][$key] = (string)$document[$key];
                    continue;
                }

                if ($value instanceof BSONDocument) {
                    $data[$i][$key] = $document[$key]->getArrayCopy();
                    continue;
                }

                $data[$i][$key] = $value;
            }
        }

        return $data;
    }
}
