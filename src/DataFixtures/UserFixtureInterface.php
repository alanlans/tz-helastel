<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\UserDto;

interface UserFixtureInterface
{
    /**
     * @return UserDto[]
     */
    public function getData(): array;
}