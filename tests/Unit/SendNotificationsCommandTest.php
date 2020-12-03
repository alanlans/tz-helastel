<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Command\SendNotificationsCommand;
use App\DataFixtures\UsersFixture;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class SendNotificationsCommandTest extends TestCase
{
    /**
     * @var UserRepositoryFactory|MockObject|null 
     */
    private ?MockObject $userRepositoryFactoryMock = null;

    private ?CommandTester $commandTester = null;

    protected function setUp()
    {
        $this->userRepositoryFactoryMock = $this->getMockBuilder(UserRepositoryFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $application = new Application();
        $application->add(new SendNotificationsCommand($this->userRepositoryFactoryMock));
        $command = $application->find('send:notifications');
        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown()
    {
        $this->userRepositoryFactoryMock = null;
        $this->commandTester = null;
    }

    public function testExecuteWithStringStrategy()
    {
        $this->userRepositoryFactoryMock
            ->expects($this->once())
            ->method('createUserRepository')
            ->willReturn(new UserRepository(new UsersFixture()));

        $this->commandTester->execute(['strategies' => ['string']]);

        $this->assertEquals('Alex NortonMarry ShawnDan Hoff', trim($this->commandTester->getDisplay()));
    }

    public function testExecuteWithTableStrategy()
    {
        $this->userRepositoryFactoryMock
            ->expects($this->once())
            ->method('createUserRepository')
            ->willReturn(new UserRepository(new UsersFixture()));

        $this->commandTester->execute(['strategies' => ['table']]);

        $this->assertEquals(
            'Alex Norton, Marry Shawn, Dan Hoff67, 18, 34alex@mail.com, mary@gmail.com, dan@ya.ru',
            trim($this->commandTester->getDisplay())
        );
    }

    public function testExecuteWithAllStrategies()
    {
        $this->userRepositoryFactoryMock
            ->expects($this->once())
            ->method('createUserRepository')
            ->willReturn(new UserRepository(new UsersFixture()));

        $this->commandTester->execute(['strategies' => ['table', 'string']]);

        $this->assertEquals(
            'Alex NortonMarry ShawnDan HoffAlex Norton, Marry Shawn, Dan Hoff67, 18, 34alex@mail.com, mary@gmail.com, dan@ya.ru',
            trim($this->commandTester->getDisplay())
        );
    }
}