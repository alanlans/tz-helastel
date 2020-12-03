<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DataFixtures\UsersFixture;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public ?array $users = null;

    public function setUp()
    {
        $usersFixture = new UsersFixture();
        $this->users = $usersFixture->getData();
    }

    public function tearDown()
    {
        $this->users = null;
    }

    public function testFindUnique()
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects($this->once())
            ->method('findUnique')
            ->willReturn(array_slice($this->users, 0, 3));

        $this->assertEquals(array_slice($this->users, 0, 3), $userRepository->findUnique());
    }
}