<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use InvalidArgumentException;
use JsonSerializable;

final class Email implements JsonSerializable
{
    private string $email;

    public function __construct(string $email)
    {
        if (empty($email)) {
            throw new InvalidArgumentException('Email is empty.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email: ' . $email);
        }

        $this->email = trim($email);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function isEqualsTo(Email $email): bool
    {
        return $this->email === (string)$email;
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
