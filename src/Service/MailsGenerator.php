<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserDto;

class MailsGenerator implements MailsGeneratorInterface
{
    /**
     * @param UserDto[] $users
     *
     * @return array
     */
    public function generate(array $users): array
    {
       return [];
    }
}