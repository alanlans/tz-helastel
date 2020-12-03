<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserDto;

interface UserRepositoryInterface
{
    /**
     * @return UserDto[]
     */
    public function findUnique(): array;
}