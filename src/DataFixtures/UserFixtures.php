<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Util\TokenGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $userPasswordEncoder;
    private $tokenGenerator;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, TokenGenerator $tokenGenerator)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->tokenGenerator = $tokenGenerator;
    }

    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->findOneBy(['username' => 'toto']);
        if (!$user) {
            $user = new User();
        }
        $user->setUsername('toto');
        $user->setEmail('toto@toto.eu');
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'toto'));
        $user->setApiToken($this->tokenGenerator->generateApiToken());
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
