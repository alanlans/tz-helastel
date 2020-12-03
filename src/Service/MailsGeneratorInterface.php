<?php

declare(strict_types=1);

namespace App\Service;

interface MailsGeneratorInterface
{
    /**
     * @param array $users
     *
     * @return array
     */
    public function generate(array $users): array;
}