<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('john.doe@example.fr')
        ->setPassword($this->hasher->hashPassword($user1, "password"))
        ->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('admin@example.fr')
        ->setPassword($this->hasher->hashPassword($user2, "admin"))
        ->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $manager->persist($user2);

        $manager->flush();
    }
}
