<?php

declare(strict_types=1);

namespace App\Auth\Domain\Factory;

use App\Auth\Domain\User;
use App\Shared\Domain\ValueObject\Email;

final class UserFactory
{
    /**
     * @param array $values
     * @return User
     */
    public static function create(array $values = []): User
    {
        $user = new User();

        if (empty($values)) {
            return $user;
        }

        if (isset($values['email'])) {
            $user->setEmail(new Email($values['email']));
            unset($values['email']);
        }

        $user->fill($values);

        return $user;
    }
}
