<?php

declare(strict_types=1);

namespace App\Repository;

use App\DataFixtures\UserFixtureInterface;
use App\Entity\UserDto;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserFixtureInterface
     */
    private UserFixtureInterface $fixtures;

    /**
     * UserRepository constructor.
     *
     * @param UserFixtureInterface $fixtures
     */
    public function __construct(UserFixtureInterface $fixtures)
    {
        $this->fixtures = $fixtures;
    }

    /**
     * @return UserDto[]
     */
    public function findUnique(): array
    {
        $users = $this->fixtures->getData();

        $knownUserIds = [];

        return array_filter($users, function (UserDto $user) use (&$knownUserIds) {
            $unique = !in_array($user->getUserId(), $knownUserIds);
            $knownUserIds[] = $user->getUserId();

            return $unique;
        });
    }
}