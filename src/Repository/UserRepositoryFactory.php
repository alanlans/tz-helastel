<?php

declare(strict_types=1);

namespace App\Repository;

use App\DataFixtures\UsersFixture;

class UserRepositoryFactory
{
    /**
     * @var UsersFixture
     */
    private UsersFixture $userFixture;

    /**
     * @param UsersFixture $userFixture
     */
    public function __construct(UsersFixture $userFixture)
    {
        $this->userFixture = $userFixture;
    }

    /**
     * @return UserRepositoryInterface
     */
    public function createUserRepository(): UserRepositoryInterface
    {
        return new UserRepository($this->userFixture);
    }
}