<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private \Faker\Generator $faker;

    private ObjectManager $manager;

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
        $this->generateUsers(2);
        $this->manager->flush();
    }
    private function generateUsers(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setPassword($this->passwordEncoder->encodePassword($user, 'testtest'));
            $this->manager->persist($user);
        }
    }
}
