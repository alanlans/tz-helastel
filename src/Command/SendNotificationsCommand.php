<?php

declare(strict_types=1);

namespace App\Command;

use App\Repository\UserRepositoryFactory;
use App\Service\MailsGenerator;
use App\Service\TemplatedEmailStringGenerator;
use App\Service\TemplatedEmailTableGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendNotificationsCommand extends Command
{
    private const STRATEGY_STRING = 'string';
    private const STRATEGY_TABLE = 'table';

    protected static $defaultName = 'send:notifications';

    private UserRepositoryFactory $userRepositoryFactory;

    /**
     * SendNotifications constructor.
     *
     * @param UserRepositoryFactory $userRepositoryFactory
     */
    public function __construct(UserRepositoryFactory $userRepositoryFactory)
    {
        parent::__construct();

        $this->userRepositoryFactory = $userRepositoryFactory;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Send notifications')
            ->addArgument(
                'strategies',
                InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                'Which notification strategies use?',
                [self::STRATEGY_STRING, self::STRATEGY_TABLE]
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userRepository = $this->userRepositoryFactory->createUserRepository();
        $users = $userRepository->findUnique();

        $strategies = $input->getArgument('strategies');

        $mails = new MailsGenerator();

        if (in_array(self::STRATEGY_STRING, $strategies)) {
            $mails = new TemplatedEmailStringGenerator($mails);
        }

        if (in_array(self::STRATEGY_TABLE, $strategies)) {
            $mails = new TemplatedEmailTableGenerator($mails);
        }

        $emails = $mails->generate($users);

        foreach ($emails as $email) {
            $output->write($email->getContext());
        }

        return 0;
    }
}
