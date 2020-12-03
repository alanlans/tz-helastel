<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserDto;

abstract class MailsDecorator implements MailsGeneratorInterface
{
    protected MailsGeneratorInterface $notificationsService;

    /**
     * NotificationsService constructor.
     *
     * @param MailsGeneratorInterface $notificationsService
     */
    public function __construct(MailsGeneratorInterface $notificationsService)
    {
        $this->notificationsService = $notificationsService;
    }

    /**
     * @param UserDto[] $users
     *
     * @return array
     */
    public function generate(array $users): array
    {
        return $this->notificationsService->generate($users);
    }
}