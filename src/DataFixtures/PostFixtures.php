<?php
namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $postsData = [
            [
                'title' => 'Découvrez Symfony 7 : Les nouveautés',
                'content' => "Symfony 7 apporte de nombreuses améliorations...\n\nAvec cette version, les développeurs bénéficient de meilleures performances, une architecture plus claire et de nouveaux outils pour accélérer le développement.\n\nLa gestion des attributs PHP 8 est désormais au cœur du framework.",
                'picture' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
                'category' => 'cat-Symfony',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-26 10:12:32',
                'ref' => 'post-symfony-7'
            ],
            [
                'title' => 'PHP 8.3 : Ce que vous devez savoir',
                'content' => "PHP 8.3 continue d'améliorer les performances...\n\nLes nouvelles fonctionnalités incluent les propriétés typées dans les classes readonly, des améliorations des expressions régulières et bien plus encore.",
                'picture' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',
                'category' => 'cat-PHP',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-24 10:12:32',
                'ref' => 'post-php-83'
            ],
            [
                'title' => 'Bootstrap 5 : Guide complet pour débutants',
                'content' => "Bootstrap 5 est le framework CSS le plus utilisé...\n\nDans ce guide, nous verrons comment créer des interfaces responsive rapidement avec le système de grille, les composants et les utilitaires CSS.",
                'picture' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800',
                'category' => 'cat-Design',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-22 10:12:32',
                'ref' => 'post-bootstrap-5'
            ],
            [
                'title' => 'Introduction à Doctrine ORM',
                'content' => "Doctrine ORM simplifie la gestion des bases de données...\n\nAvec Doctrine, vous pouvez manipuler vos données comme des objets PHP. Les relations, les migrations et les requêtes sont gérées de manière élégante.",
                'picture' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800',
                'category' => 'cat-Symfony',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-27 10:12:32',
                'ref' => 'post-doctrine'
            ],
            [
                'title' => 'Créer une API REST avec Symfony',
                'content' => "Symfony est une excellente base pour créer des APIs...\n\nGrâce aux composants Serializer, Validator et Security, vous pouvez construire des APIs robustes et sécurisées en peu de temps.",
                'picture' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=800',
                'category' => 'cat-Technologie',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-20 10:12:32',
                'ref' => 'post-api-rest'
            ],
            [
                'title' => 'Les tendances UX/UI en 2025',
                'content' => "Le design d'interface évolue constamment...\n\nEn 2025, on observe une montée du neumorphisme, des micro-interactions fluides et une attention particulière portée à l'accessibilité.\n\nLes utilisateurs attendent désormais des expériences personnalisées et inclusives.",
                'picture' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800',
                'category' => 'cat-Design',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-28 10:12:32',
                'ref' => 'post-ux-ui'
            ],
            [
                'title' => "IA et développement web : L'avenir du code",
                'content' => "L'intelligence artificielle transforme le développement...\n\nDes outils comme GitHub Copilot et ChatGPT révolutionnent la façon dont nous codons. Cependant, la maîtrise des fondamentaux reste essentielle.\n\nL'IA est un assistant, pas un remplaçant.",
                'picture' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800',
                'category' => 'cat-Actualités',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-23 10:12:32',
                'ref' => 'post-ia-web'
            ],
            [
                'title' => 'Elden Ring',
                'content' => "Bayle le Terrible est un boss extrêmement puissant du DLC Shadow of Erdtree d'Elden Ring...",
                'picture' => 'https://eldenring.wiki.fextralife.com/file/Elden-Ring/bayle_the_dread_bosses_elden_ring_wiki_1200px.png',
                'category' => 'cat-Gaming',
                'author' => AdminFixtures::ALEXIS_REF,
                'date' => '2026-02-12 13:11:32',
                'ref' => 'post-elden-ring'
            ],
        ];

        foreach ($postsData as $data) {
            $post = new Post();
            $post->setTitle($data['title'])
                 ->setContent($data['content'])
                 ->setPicture($data['picture'])
                 ->setCategory($this->getReference($data['category'], Category::class))
                 ->setAuthor($this->getReference($data['author'], User::class))
                 ->setPublishedAt(new \DateTimeImmutable($data['date']));

            $manager->persist($post);
            // On ajoute une référence pour que CommentFixtures puisse s'y lier
            $this->addReference($data['ref'], $post);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AdminFixtures::class,
            UserFixtures::class,
            CategoryFixtures::class,
        ];
    }
}