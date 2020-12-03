<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DataFixtures\UsersFixture;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryFactory;
use PHPUnit\Framework\TestCase;

class UserRepositoryFactoryTest extends TestCase
{
    public function testCreatedRepository()
    {
        $usersFixture = new UsersFixture();

        $userRepositoryFactory = new UserRepositoryFactory($usersFixture);

        $this->assertInstanceOf(UserRepository::class, $userRepositoryFactory->createUserRepository());
    }
}