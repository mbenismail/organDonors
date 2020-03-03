<?php

namespace App\DataFixtures;

use App\Entity\Hospital;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager )
    {
        $user = new User();
        $user->setEmail('dn@dn.com') ;
        $user->setUsername('dn') ;
        $user->setRoles(['ROLE_ADMIN']) ;

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'demo'
        ));
        $manager->persist($user);
        $manager->flush();

        $Hospital = new Hospital();
        $Hospital->setNameHosp('faisal') ;
        $Hospital->setAddress('riyadh') ;
        $Hospital->setContactNumber('012333445') ;

        $manager->persist($Hospital);
        $manager->flush();

    }
}
