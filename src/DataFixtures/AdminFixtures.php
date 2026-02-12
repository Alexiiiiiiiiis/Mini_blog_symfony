<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    public const ADMIN_REF = 'admin-main';
    public const ALEXIS_REF = 'admin-alexis';

    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // Admin principal
        $admin = new User();
        $admin->setEmail('admin@blog.com')
              ->setFirstName('Admin')
              ->setLastName('Blog')
              ->setRoles(['ROLE_ADMIN'])
              ->setIsActive(true)
              ->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);
        $this->addReference(self::ADMIN_REF, $admin);

        // Admin Alexis
        $alexis = new User();
        $alexis->setEmail('alexis.rodrigues95140@gmail.com')
               ->setFirstName('Alexis')
               ->setLastName('Rodrigues')
               ->setRoles(['ROLE_ADMIN'])
               ->setIsActive(true)
               ->setProfilePicture('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFH6wVQiyNAj5KJYkcKXvocB-aILcknKTv1PAGz7PtmW1PCqvUbBBu3lZ9o-YcSW_5IIOx9lINscrp8JiCh84HV1onsFz6lP-FfOu_pg&s=10')
               ->setPassword($this->hasher->hashPassword($alexis, 'admin123'));
        $manager->persist($alexis);
        $this->addReference(self::ALEXIS_REF, $alexis);

        $manager->flush();
    }
}