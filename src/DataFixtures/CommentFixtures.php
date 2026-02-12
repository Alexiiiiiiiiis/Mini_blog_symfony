<?php
namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $commentsData = [
            [
                'content' => "Excellent article ! Symfony 7 apporte vraiment de belles améliorations. J'ai hâte de migrer mes projets.",
                'post' => 'post-symfony-7',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-01-26 14:30:00',
            ],
            [
                'content' => "Merci pour ce guide détaillé. Les attributs PHP 8 simplifient vraiment le code !",
                'post' => 'post-symfony-7',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-01-26 16:45:00',
            ],
            [
                'content' => "PHP 8.3 est incroyable ! Les performances sont vraiment au rendez-vous. Bravo pour l'article.",
                'post' => 'post-php-83',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-01-24 11:20:00',
            ],
            [
                'content' => "J'ai une question : les propriétés readonly sont-elles rétrocompatibles avec PHP 8.2 ?",
                'post' => 'post-php-83',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-01-24 15:10:00',
            ],
            [
                'content' => "Bootstrap 5 a changé ma façon de développer. Fini jQuery, place au JavaScript vanilla !",
                'post' => 'post-bootstrap-5',
                'author' => AdminFixtures::ALEXIS_REF,
                'date' => '2026-01-22 12:00:00',
            ],
            [
                'content' => "Super tutoriel ! Le système de grille est tellement intuitif maintenant.",
                'post' => 'post-bootstrap-5',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-01-22 18:30:00',
            ],
            [
                'content' => "Doctrine est un must-have pour tout projet Symfony. Merci pour cette introduction claire !",
                'post' => 'post-doctrine',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-01-27 13:45:00',
            ],
            [
                'content' => "Les migrations automatiques sont ma fonctionnalité préférée. Plus d'erreurs de schéma !",
                'post' => 'post-doctrine',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-01-27 19:20:00',
            ],
            [
                'content' => "Article très pertinent ! J'ai utilisé ce guide pour créer mon API e-commerce.",
                'post' => 'post-api-rest',
                'author' => AdminFixtures::ALEXIS_REF,
                'date' => '2026-01-20 14:00:00',
            ],
            [
                'content' => "La sérialisation avec Symfony est vraiment puissante. Merci pour les exemples concrets.",
                'post' => 'post-api-rest',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-01-20 17:30:00',
            ],
            [
                'content' => "Le neumorphisme est magnifique mais attention à l'accessibilité ! Bon rappel dans l'article.",
                'post' => 'post-ux-ui',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-01-28 10:15:00',
            ],
            [
                'content' => "Les micro-interactions font vraiment la différence. J'adore cette tendance !",
                'post' => 'post-ux-ui',
                'author' => AdminFixtures::ALEXIS_REF,
                'date' => '2026-01-28 15:45:00',
            ],
            [
                'content' => "Super article sur les tendances design ! Le mode sombre reste mon préféré.",
                'post' => 'post-ux-ui',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-01-28 20:30:00',
            ],
            [
                'content' => "L'IA est un outil formidable mais effectivement, les bases restent essentielles. Bien dit !",
                'post' => 'post-ia-web',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-01-23 11:00:00',
            ],
            [
                'content' => "GitHub Copilot m'a fait gagner tellement de temps ! Mais je vérifie toujours le code généré.",
                'post' => 'post-ia-web',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-01-23 16:20:00',
            ],
            [
                'content' => "L'avenir du développement est passionnant. Merci pour cette réflexion !",
                'post' => 'post-ia-web',
                'author' => AdminFixtures::ALEXIS_REF,
                'date' => '2026-01-23 21:00:00',
            ],
            [
                'content' => "BAYLE LE TERRIBLE ! Ce boss m'a donné du fil à retordre pendant des heures 😅",
                'post' => 'post-elden-ring',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-02-12 14:00:00',
            ],
            [
                'content' => "Shadow of Erdtree est un DLC incroyable ! Les boss sont vraiment épiques.",
                'post' => 'post-elden-ring',
                'author' => UserFixtures::HUGO_REF,
                'date' => '2026-02-12 15:30:00',
            ],
            [
                'content' => "J'ai battu Bayle en 47 essais... Ce boss est une légende ! Merci pour l'article.",
                'post' => 'post-elden-ring',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-02-12 17:45:00',
            ],
            [
                'content' => "FromSoftware ne déçoit jamais. Vivement le prochain jeu !",
                'post' => 'post-elden-ring',
                'author' => UserFixtures::JEAN_REF,
                'date' => '2026-02-12 19:20:00',
            ],
        ];

        foreach ($commentsData as $data) {
            $comment = new Comment();
            $comment->setContent($data['content'])
                    ->setPost($this->getReference($data['post'], Post::class))
                    ->setAuthor($this->getReference($data['author'], User::class))
                    ->setCreatedAt(new \DateTimeImmutable($data['date']))
                    ->setStatus('valide');

            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PostFixtures::class,
            UserFixtures::class,
            AdminFixtures::class,
        ];
    }
}