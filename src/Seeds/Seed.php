<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // Admin
        $admin = new User();
        $admin->setEmail('admin@blog.com')
              ->setFirstName('Admin')
              ->setLastName('Blog')
              ->setRoles(['ROLE_ADMIN'])
              ->setIsActive(true)
              ->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        // Regular user
        $user = new User();
        $user->setEmail('user@blog.com')
             ->setFirstName('Jean')
             ->setLastName('Dupont')
             ->setRoles(['ROLE_USER'])
             ->setIsActive(true)
             ->setPassword($this->hasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        // Categories
        $categories = [];
        foreach (['Technologie', 'Symfony', 'PHP', 'Design', 'Actualités'] as $name) {
            $cat = new Category();
            $cat->setName($name)->setDescription("Articles sur le thème $name");
            $manager->persist($cat);
            $categories[] = $cat;
        }

        // Posts
        $posts = [
            ['Découvrez Symfony 7 : Les nouveautés', "Symfony 7 apporte de nombreuses améliorations...\n\nAvec cette version, les développeurs bénéficient de meilleures performances, une architecture plus claire et de nouveaux outils pour accélérer le développement.\n\nLa gestion des attributs PHP 8 est désormais au cœur du framework.", 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800', 1],
            ['PHP 8.3 : Ce que vous devez savoir', "PHP 8.3 continue d'améliorer les performances...\n\nLes nouvelles fonctionnalités incluent les propriétés typées dans les classes readonly, des améliorations des expressions régulières et bien plus encore.", 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800', 2],
            ['Bootstrap 5 : Guide complet pour débutants', "Bootstrap 5 est le framework CSS le plus utilisé...\n\nDans ce guide, nous verrons comment créer des interfaces responsive rapidement avec le système de grille, les composants et les utilitaires CSS.", 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800', 3],
            ['Introduction à Doctrine ORM', "Doctrine ORM simplifie la gestion des bases de données...\n\nAvec Doctrine, vous pouvez manipuler vos données comme des objets PHP. Les relations, les migrations et les requêtes sont gérées de manière élégante.", 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800', 1],
            ['Créer une API REST avec Symfony', "Symfony est une excellente base pour créer des APIs...\n\nGrâce aux composants Serializer, Validator et Security, vous pouvez construire des APIs robustes et sécurisées en peu de temps.", 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=800', 0],
        ];

        foreach ($posts as [$title, $content, $pic, $catIdx]) {
            $post = new Post();
            $post->setTitle($title)
                 ->setContent($content)
                 ->setPicture($pic)
                 ->setCategory($categories[$catIdx])
                 ->setAuthor($admin)
                 ->setPublishedAt(new \DateTimeImmutable('-' . rand(1, 30) . ' days'));
            $manager->persist($post);

            // Add comments
            foreach (['Super article, merci !', 'Très instructif et bien expliqué.', 'J\'attendais cet article depuis longtemps !'] as $i => $text) {
                if ($i > rand(0, 2)) break;
                $comment = new Comment();
                $comment->setContent($text)
                        ->setAuthor($user)
                        ->setPost($post)
                        ->setStatus('approved');
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}
