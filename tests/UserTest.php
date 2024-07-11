<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSomething(): void
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $user->setEmail("test@test.test");
        $this->assertEquals("test@test.test", $user->getEmail());
        $user->setPassword("test");
        $this->assertEquals("test", $user->getPassword());
        $user->setRoles(["ROLE_TEST"]);
        $this->assertContains("ROLE_TEST", $user->getRoles());
    }
}
