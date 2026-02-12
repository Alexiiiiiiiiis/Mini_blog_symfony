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
                'content' => "Symfony 7 apporte de nombreuses améliorations qui transforment l'expérience de développement. Cette nouvelle version majeure du framework PHP le plus populaire introduit des fonctionnalités innovantes qui simplifient le code et accélèrent les performances.

Avec cette version, les développeurs bénéficient de meilleures performances grâce à une optimisation approfondie du noyau. L'architecture est plus claire et modulaire, permettant une meilleure organisation des projets. De nouveaux outils sont disponibles pour accélérer le développement, notamment un système de cache amélioré et des composants réutilisables plus puissants.

La gestion des attributs PHP 8 est désormais au cœur du framework. Fini les annotations en commentaires, place aux attributs natifs qui offrent une meilleure intégration avec les IDE et une validation au moment de la compilation. Les routes, les validations et les configurations de sécurité peuvent maintenant être définies directement avec des attributs, rendant le code plus lisible et maintenable.

Le système de console a également été revu pour offrir une meilleure expérience utilisateur avec des commandes interactives et un affichage amélioré. Les développeurs apprécieront particulièrement les nouvelles fonctionnalités d'autocomplétion et les suggestions contextuelles.

En conclusion, Symfony 7 représente une évolution majeure qui mérite l'attention de tous les développeurs PHP souhaitant construire des applications web modernes et performantes.",
                'picture' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
                'category' => 'cat-Symfony',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-26 10:12:32',
                'ref' => 'post-symfony-7'
            ],
            [
                'title' => 'PHP 8.3 : Ce que vous devez savoir',
                'content' => "PHP 8.3 continue d'améliorer les performances et la qualité du langage avec des fonctionnalités attendues par la communauté des développeurs. Cette version apporte son lot de nouveautés qui rendent le code plus expressif et performant.

Les nouvelles fonctionnalités incluent les propriétés typées dans les classes readonly, permettant une immutabilité encore plus stricte et sécurisée. Cette évolution facilite la création d'objets valeur et de DTOs (Data Transfer Objects) sans risque de modification accidentelle après leur création.

Les améliorations des expressions régulières rendent les patterns plus lisibles et maintenables. Le support JSON a été optimisé pour de meilleures performances lors de la sérialisation et désérialisation de grandes structures de données.

PHP 8.3 introduit également des constantes de classe typées, permettant de définir le type exact d'une constante et d'éviter des erreurs subtiles. Le système de types continue de s'enrichir avec de nouvelles possibilités pour décrire précisément les structures de données attendues.

Les performances générales ont été améliorées avec une réduction de la consommation mémoire et une exécution plus rapide des scripts. Les développeurs qui migrent vers PHP 8.3 constatent en moyenne une amélioration de 10 à 15% des temps de réponse.",
                'picture' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',
                'category' => 'cat-PHP',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-24 10:12:32',
                'ref' => 'post-php-83'
            ],
            [
                'title' => 'Bootstrap 5 : Guide complet pour débutants',
                'content' => "Bootstrap 5 est le framework CSS le plus utilisé au monde pour créer des interfaces web modernes et responsive. Cette nouvelle version marque un tournant majeur en abandonnant jQuery pour se concentrer sur du JavaScript vanilla pur.

Dans ce guide, nous verrons comment créer des interfaces responsive rapidement avec le système de grille flexbox. La grille Bootstrap permet de créer des mises en page complexes qui s'adaptent automatiquement à tous les écrans, du smartphone au grand écran desktop.

Les composants Bootstrap 5 sont nombreux et variés : cartes, modales, accordéons, carrousels, alertes et bien d'autres. Chaque composant est personnalisable via des classes utilitaires ou des variables Sass. L'utilisation de ces composants permet de gagner un temps considérable en développement.

Les utilitaires CSS sont particulièrement puissants. Ils permettent de modifier les marges, paddings, couleurs, tailles de texte et bien plus encore sans écrire une seule ligne de CSS personnalisé. Cette approche utility-first rend le développement plus rapide et le code plus maintenable.

Bootstrap 5 intègre également des icônes officielles avec Bootstrap Icons, une bibliothèque gratuite de plus de 1800 icônes SVG. L'accessibilité a été grandement améliorée avec un support ARIA complet et des composants qui respectent les standards WCAG 2.1.",
                'picture' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800',
                'category' => 'cat-Design',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-22 10:12:32',
                'ref' => 'post-bootstrap-5'
            ],
            [
                'title' => 'Introduction à Doctrine ORM',
                'content' => "Doctrine ORM simplifie la gestion des bases de données en permettant de manipuler les données comme des objets PHP. Fini les requêtes SQL complexes, place à une approche orientée objet élégante et maintenable.

Avec Doctrine, vous pouvez manipuler vos données comme des objets PHP standards. Les entités représentent les tables de votre base de données et les propriétés correspondent aux colonnes. Cette abstraction permet d'écrire du code plus lisible et moins sujet aux erreurs.

Les relations entre entités sont gérées de manière élégante avec des annotations ou attributs. OneToMany, ManyToOne, ManyToMany : toutes les relations SQL classiques peuvent être exprimées simplement dans vos classes PHP. Doctrine se charge automatiquement de générer les bonnes requêtes et de gérer les clés étrangères.

Le système de migrations est un atout majeur de Doctrine. Il permet de versionner votre schéma de base de données comme du code source. Chaque modification de structure génère un fichier de migration qui peut être appliqué ou annulé facilement, facilitant le travail en équipe et le déploiement.

Le Query Builder offre une API fluide pour construire des requêtes complexes sans écrire de SQL. Pour les cas plus avancés, DQL (Doctrine Query Language) permet d'écrire des requêtes qui ressemblent à SQL mais travaillent avec des objets plutôt que des tables.

Les performances sont excellentes grâce à un système de cache sophistiqué et à la possibilité de charger les relations de manière optimisée (eager loading). Doctrine est devenu l'ORM de référence pour Symfony et de nombreux autres projets PHP.",
                'picture' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800',
                'category' => 'cat-Symfony',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-27 10:12:32',
                'ref' => 'post-doctrine'
            ],
            [
                'title' => 'Créer une API REST avec Symfony',
                'content' => "Symfony est une excellente base pour créer des APIs REST modernes, performantes et sécurisées. Le framework offre tous les outils nécessaires pour construire des APIs professionnelles en un temps record.

Grâce aux composants Serializer, Validator et Security, vous pouvez construire des APIs robustes et sécurisées en peu de temps. Le Serializer transforme automatiquement vos objets PHP en JSON ou XML, avec un contrôle fin sur les données exposées grâce aux groupes de sérialisation.

Le composant Validator permet de valider les données entrantes avec des contraintes déclaratives. Vous définissez les règles directement sur vos entités avec des attributs, et Symfony se charge de vérifier que toutes les données reçues sont conformes avant de les persister en base.

La sécurité est primordiale pour une API. Symfony offre plusieurs mécanismes d'authentification : JWT tokens, API keys, OAuth2. Le composant Security peut être configuré finement pour protéger chaque endpoint avec des rôles et des permissions précises.

Les routes d'API peuvent être versionnées facilement, permettant de maintenir plusieurs versions en parallèle pendant les phases de migration. Le format JSON:API ou JSON-LD peuvent être implémentés simplement avec API Platform, une surcouche Symfony spécialisée dans les APIs REST.

La documentation automatique avec OpenAPI/Swagger est un plus appréciable. Vos endpoints sont documentés automatiquement avec leurs paramètres, codes de retour et schémas de données. Les développeurs front-end apprécient cette documentation toujours à jour.",
                'picture' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=800',
                'category' => 'cat-Technologie',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-20 10:12:32',
                'ref' => 'post-api-rest'
            ],
            [
                'title' => 'Les tendances UX/UI en 2025',
                'content' => "Le design d'interface évolue constamment pour répondre aux nouvelles attentes des utilisateurs et aux possibilités offertes par les technologies modernes. L'année 2025 marque un tournant dans la façon dont nous concevons les expériences digitales.

En 2025, on observe une montée du neumorphisme, un style qui crée une illusion de relief subtile avec des ombres et des lumières douces. Cette approche apporte de la profondeur aux interfaces sans la lourdeur du skeuomorphisme des années 2010.

Les micro-interactions fluides deviennent la norme plutôt que l'exception. Chaque clic, survol ou action déclenche une animation subtile qui guide l'utilisateur et rend l'interface plus vivante. Ces petits détails font toute la différence dans la perception de qualité d'un produit.

Une attention particulière est portée à l'accessibilité, qui n'est plus une option mais une nécessité. Les ratios de contraste sont soigneusement calculés, la navigation au clavier est fluide, et les lecteurs d'écran sont pris en compte dès la conception. Les designers utilisent des outils comme axe DevTools pour valider l'accessibilité de leurs créations.

Les utilisateurs attendent désormais des expériences personnalisées et inclusives. Les interfaces s'adaptent aux préférences de chacun : mode sombre automatique, tailles de texte ajustables, animations réduites pour les personnes sensibles au mouvement. La personnalisation n'est plus un luxe mais un standard.

Le design system devient incontournable dans les équipes de taille moyenne et grande. Il permet de maintenir une cohérence visuelle et comportementale à travers tous les produits d'une entreprise. Des outils comme Figma facilitent la collaboration entre designers et développeurs.",
                'picture' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800',
                'category' => 'cat-Design',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-28 10:12:32',
                'ref' => 'post-ux-ui'
            ],
            [
                'title' => "IA et développement web : L'avenir du code",
                'content' => "L'intelligence artificielle transforme le développement web de manière profonde et durable. Les outils d'IA générative changent radicalement notre façon d'écrire du code et de concevoir des applications.

Des outils comme GitHub Copilot et ChatGPT révolutionnent la façon dont nous codons au quotidien. Copilot suggère des lignes entières de code en fonction du contexte, accélérant considérablement le développement des fonctionnalités répétitives. ChatGPT peut expliquer du code complexe, déboguer des erreurs ou même générer des tests unitaires.

Cependant, la maîtrise des fondamentaux reste essentielle pour être un bon développeur. L'IA peut générer du code, mais elle ne comprend pas toujours le contexte métier, les contraintes de performance ou les bonnes pratiques spécifiques à votre projet. Un développeur expérimenté sait quand utiliser l'IA et quand s'en passer.

L'IA est un assistant, pas un remplaçant. Elle excelle dans les tâches répétitives, la génération de code boilerplate, ou la recherche rapide de solutions à des problèmes courants. Mais la conception architecturale, les décisions techniques importantes et la compréhension des besoins métier restent des domaines où l'humain est irremplaçable.

Les développeurs qui réussissent dans ce nouvel environnement sont ceux qui apprennent à collaborer efficacement avec l'IA. Ils savent poser les bonnes questions, valider les réponses, et intégrer les suggestions dans leur workflow sans perdre de vue la qualité du code produit.

L'avenir du développement web sera hybride : une collaboration étroite entre l'intelligence humaine créative et l'IA qui automatise les tâches fastidieuses. Les développeurs qui embrassent cette évolution tout en maintenant leurs compétences fondamentales seront les plus recherchés.",
                'picture' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800',
                'category' => 'cat-Actualités',
                'author' => AdminFixtures::ADMIN_REF,
                'date' => '2026-01-23 10:12:32',
                'ref' => 'post-ia-web'
            ],
            [
                'title' => 'Elden Ring : Bayle le Terrible, le boss ultime',
                'content' => "Bayle le Terrible est un boss extrêmement puissant du DLC Shadow of Erdtree d'Elden Ring. Ce dragon ancien représente l'un des défis les plus redoutables jamais créés par FromSoftware, dépassant même certains boss du jeu de base en termes de difficulté.

Situé au sommet des Pics Déchiquetés, Bayle domine le paysage avec sa présence imposante. Son design est spectaculaire : un dragon rouge massif avec des ailes déchirées et une rage palpable dans chacun de ses mouvements. L'atmosphère du combat est épique, accompagnée d'une musique orchestrale grandiose qui intensifie chaque phase de l'affrontement.

Les patterns d'attaque de Bayle sont impitoyables et demandent une lecture parfaite des animations. Ses attaques de souffle enflammé couvrent des zones immenses, ses coups de griffes sont rapides et mortels, et ses charges aériennes nécessitent un timing précis pour être esquivées. La deuxième phase introduit des attaques encore plus dévastatrices, avec des combos qui peuvent one-shot même les builds les plus résistantes.

La stratégie optimale varie selon votre build. Les guerriers en mêlée doivent rester près de ses pattes arrière pour éviter les attaques de souffle, tout en faisant attention aux piétinements. Les mages peuvent profiter des ouvertures pendant ses envolées pour lancer des sorts puissants. Les builds d'incantations draconiques sont particulièrement efficaces grâce à leur synergie thématique.

L'équipement recommandé inclut des armures avec haute résistance au feu et des talismans qui augmentent la robustesse pour éviter d'être stagné. Le Bouclier Sacré de la Bête ou le Talisman de la Grâce Dorée peuvent faire la différence dans les moments critiques.

La communauté Elden Ring considère Bayle comme l'un des meilleurs boss du jeu, alliant difficulté équitable et spectacle visuel. Battre Bayle est une véritable épreuve qui demande patience, persévérance et maîtrise des mécaniques. La satisfaction de vaincre ce titan est immense et marque l'un des moments forts du DLC Shadow of Erdtree.",
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