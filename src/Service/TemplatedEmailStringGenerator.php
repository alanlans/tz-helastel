<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class TemplatedEmailStringGenerator extends MailsDecorator
{
    /**
     * @param array $users
     *
     * @return array
     */
    public function generate(array $users): array
    {
        $mails = $this->notificationsService->generate($users);
        foreach ($users as $user) {
            $mail = new TemplatedEmail();
            $mail
                ->from('helastel@mail.com')
                ->to($user->getEmail())
                ->htmlTemplate('mail/strategy-string.html.twig')
                ->context(['name' => $user->getName()]);

            $mails[] = $mail;
        }

        return $mails;
    }
}