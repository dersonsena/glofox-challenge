<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\Contracts\UserRepository;

final class AuthByEmailPassword
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(InputBoundery $input): OutputBoundary
    {
        
        
        return OutputBoundary::build([]);
    }
}
