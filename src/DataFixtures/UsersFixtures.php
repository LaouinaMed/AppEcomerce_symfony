<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder , private SluggerInterface $slugger) 
    {

    }



    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@gmail.com');
        $admin->setLastname('laouina');
        $admin->setFirstname('simo');
        $admin->setAddress('12 Rue Du Khabaza');
        $admin->setCity('Kenitra');
        $admin->setZipcode(10000);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin , 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);   
        
        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 5 ; $usr++)
        {
            $user = new Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setCity($faker->city);
            $user->setZipcode(str_replace(' ', '', $faker->postcode));
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user , 'secret')
            );
            
            
            $manager->persist($user); 
        }
        

        $manager->flush();
    }
}
