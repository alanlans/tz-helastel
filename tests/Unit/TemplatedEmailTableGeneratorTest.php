<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DataFixtures\UsersFixture;
use App\Service\TemplatedEmailTableGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class TemplatedEmailTableGeneratorTest extends TestCase
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
            ->to('admin@admin.ru')
            ->htmlTemplate('mail/strategy-table.html.twig')
            ->context([
                'name'   => 'Alex Norton, Marry Shawn, Dan Hoff',
                'age'    => '67, 18, 34',
                'emails' => 'alex@mail.com, mary@gmail.com, dan@ya.ru',
            ]);

        $templatedEmailTableGenerator = $this->createMock(TemplatedEmailTableGenerator::class);
        $templatedEmailTableGenerator
            ->expects($this->once())
            ->method('generate')
            ->with([$this->users[0]])
            ->willReturn([$mail]);

        $this->assertEquals([$mail], $templatedEmailTableGenerator->generate([$this->users[0]]));
    }
}