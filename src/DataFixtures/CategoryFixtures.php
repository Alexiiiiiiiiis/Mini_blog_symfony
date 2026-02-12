<?php
namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Technologie', 'Symfony', 'PHP', 'Design', 'Actualités', 'Gaming'
        ];

        foreach ($categories as $name) {
            $category = new Category();
            $category->setName($name)->setDescription("Articles sur le thème $name");
            
            $manager->persist($category);
            $this->addReference('cat-' . $name, $category);
        }

        $manager->flush();
    }
}