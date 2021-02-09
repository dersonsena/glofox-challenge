<?php

declare(strict_types=1);

namespace App\Lesson\Application\UseCases\Create;

use App\Shared\Helpers\DTO;

final class OutputBoundary extends DTO
{
    protected string $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
