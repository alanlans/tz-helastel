<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DataFixtures\UsersFixture;
use App\Service\TemplatedEmailStringGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class TemplatedEmailStringGeneratorTest extends TestCase
{
    public ?array $users = null;

    public function setUp()
    {
        $usersFixture = new UsersFixture();
        $this->users = $usersFixture->getData();
    }

    public function tearDown()
    {
        $this->users = null;
    }

    public function testGeneratedEmails()
    {
        $mail = new TemplatedEmail();
        $mail
            ->from('helastel@mail.com')
            ->to('alex@mail.com')
            ->htmlTemplate('mail/strategy-string.html.twig')
            ->context(['name' => 'Alex Norton']);

        $templatedEmailStringGenerator = $this->createMock(TemplatedEmailStringGenerator::class);
        $templatedEmailStringGenerator
            ->expects($this->once())
            ->method('generate')
            ->with([$this->users[0]])
            ->willReturn([$mail]);

        $this->assertEquals([$mail], $templatedEmailStringGenerator->generate([$this->users[0]]));
    }
}