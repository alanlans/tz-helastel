<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserDto;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class TemplatedEmailTableGenerator extends MailsDecorator
{
    /**
     * @param array $users
     *
     * @return array
     */
    public function generate(array $users): array
    {
        $mail = new TemplatedEmail();
        $mail
            ->from('helastel@mail.com')
            ->to('admin@admin.ru')
            ->htmlTemplate('mail/strategy-table.html.twig')
            ->context([
                'name'  => implode(', ', array_map(fn(UserDto $user) => $user->getName(), $users)),
                'age'   => implode(', ', array_map(fn(UserDto $user) => $user->getAge(), $users)),
                'emails' => implode(', ', array_map(fn(UserDto $user) => $user->getEmail(), $users)),
            ]);

        $mails = $this->notificationsService->generate($users);
        $mails[] = $mail;

        return $mails;
    }
}