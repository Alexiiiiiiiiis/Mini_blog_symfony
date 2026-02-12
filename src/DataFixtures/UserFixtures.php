<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const JEAN_REF = 'user-jean';
    public const HUGO_REF = 'user-hugo';

    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // User Jean Dupont
        $jean = new User();
        $jean->setEmail('user@blog.com')
             ->setFirstName('Jean')
             ->setLastName('Dupont')
             ->setRoles(['ROLE_USER'])
             ->setIsActive(true)
             ->setProfilePicture('https://parcsaintecroix.com/wp-content/uploads/2024/06/cp-e-wittwer-6-2-500x500-ad0950baee13.png')
             ->setPassword($this->hasher->hashPassword($jean, 'user123'));
        $manager->persist($jean);
        $this->addReference(self::JEAN_REF, $jean);

        // User Hugo Lemoine
        $hugo = new User();
        $hugo->setEmail('prof@blog.com')
             ->setFirstName('Hugo')
             ->setLastName('Lemoine')
             ->setRoles(['ROLE_USER'])
             ->setIsActive(true)
             ->setPassword($this->hasher->hashPassword($hugo, 'user321'));
        $manager->persist($hugo);
        $this->addReference(self::HUGO_REF, $hugo);

        $manager->flush();
    }
}