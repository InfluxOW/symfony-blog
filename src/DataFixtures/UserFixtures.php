<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends AppFixtures
{
    public function __construct(protected UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setFullName($this->faker->name);
            $user->setEmail($this->faker->unique()->email);
            $user->setUsername($this->faker->unique()->userName);
            $user->setPassword($this->hasher->hashPassword($user, $this->faker->words(3, true)));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
