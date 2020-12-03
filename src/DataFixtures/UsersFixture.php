<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\UserDto;

class UsersFixture implements UserFixtureInterface
{
    /**
     * @var UserDto[]
     */
    protected array $users;

    public function load(): void
    {
        $user1 = new UserDto();
        $user1
            ->setUserId(1)
            ->setEmail('alex@mail.com')
            ->setAge(67)
            ->setName('Alex Norton');

        $this->users[] = $user1;

        $user2 = new UserDto();
        $user2
            ->setUserId(2)
            ->setEmail('mary@gmail.com')
            ->setAge(18)
            ->setName('Marry Shawn');

        $this->users[] = $user2;

        $user3 = new UserDto();
        $user3
            ->setUserId(3)
            ->setEmail('dan@ya.ru')
            ->setAge(34)
            ->setName('Dan Hoff');

        $this->users[] = $user3;

        $user4 = new UserDto();
        $user4
            ->setUserId(1)
            ->setEmail('alex@mail.com')
            ->setAge(67)
            ->setName('Alex Norton');

        $this->users[] = $user4;
    }

    /**
     * @return UserDto[]
     */
    public function getData(): array
    {
        $this->load();

        return $this->users;
    }
}