#  Projet Blog Symfony 

Un blog complet développé avec **Symfony 7**, **Bootstrap 5** et **Doctrine ORM**, avec gestion des rôles (Admin, Utilisateur, Visiteur).

---

## ✨ Fonctionnalités

### 👥 Rôles utilisateurs
| Fonctionnalité | Visiteur | Utilisateur | Admin |
|---|---|---|---|
| Voir les articles | ✅ | ✅ | ✅ |
| Lire un article | ✅ | ✅ | ✅ |
| Voir les commentaires | ✅ | ✅ | ✅ |
| Ajouter un commentaire | ❌ | ✅ | ✅ |
| Gérer son profil | ❌ | ✅ | ✅ |
| Créer/modifier/supprimer un article | ❌ | ❌ | ✅ |
| Gérer les utilisateurs | ❌ | ❌ | ✅ |
| Modérer les commentaires | ❌ | ❌ | ✅ |
| Gérer les catégories | ❌ | ❌ | ✅ |

---

## 🗃️ Structure des entités

```
User          Post            Comment          Category
────────────  ────────────    ────────────     ────────────
id            id              id               id
email         title           content          name
password      content         createdAt        description
roles         publishedAt     status
firstName     picture         author (User)
lastName      author (User)   post (Post)
profilePic    category (Cat)
createdAt     comments []
updatedAt
isActive
posts []
comments []
```

---

## ⚙️ Installation

### Prérequis
- PHP 8.2+
- Composer
- MySQL 8.0+ ou MariaDB
- Symfony CLI 

### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/votre-username/symfony-blog.git
cd symfony-blog

# 2. Installer les dépendances
composer install

# 3. Configurer la base de données
# Copier le fichier .env et modifier DATABASE_URL
cp .env .env.local
# Éditer .env.local :
# DATABASE_URL="mysql://root:motdepasse@127.0.0.1:3306/symfony_blog"

# 4. Créer la base de données
php bin/console doctrine:database:create

# 5. Exécuter les migrations
php bin/console doctrine:migrations:migrate

# 6. Charger les données de test (optionnel)
composer require --dev doctrine/doctrine-fixtures-bundle
php bin/console doctrine:fixtures:load

# 7. Lancer le serveur
symfony serve

```

### 🔑 Comptes de test (après fixtures)
| Email | Mot de passe | Rôle |
|---|---|---|
| admin@blog.com | admin123 | ROLE_ADMIN |
| user@blog.com | user123 | ROLE_USER |

---

## 🗂️ Structure du projet

```
symfony-blog/
├── src/
│   ├── Controller/
│   │   ├── AdminController.php      # Gestion admin complète
│   │   ├── BlogController.php       # Pages publiques blog
│   │   ├── SecurityController.php   # Login / Register
│   │   └── ProfileController.php   # Profil utilisateur
│   ├── Entity/
│   │   ├── User.php
│   │   ├── Post.php
│   │   ├── Comment.php
│   │   └── Category.php
│   ├── Form/
│   │   ├── PostType.php
│   │   ├── CommentType.php
│   │   ├── CategoryType.php
│   │   └── RegistrationFormType.php
│   ├── Repository/               # Repositories Doctrine
│   ├── Security/
│   │   └── LoginFormAuthenticator.php
│   └── DataFixtures/
│       └── AppFixtures.php
├── templates/
│   ├── base.html.twig
│   ├── blog/
│   │   ├── index.html.twig         # Liste des articles + sidebar
│   │   └── show.html.twig          # Détail article + commentaires
│   ├── admin/
│   │   ├── base.html.twig          # Layout admin avec sidebar
│   │   ├── dashboard.html.twig     # Tableau de bord
│   │   ├── posts/                  # CRUD articles
│   │   ├── users/                  # Gestion utilisateurs
│   │   ├── comments/               # Modération commentaires
│   │   └── categories/             # CRUD catégories
│   ├── security/
│   │   └── login.html.twig
│   ├── registration/
│   │   └── register.html.twig
│   └── profile/
│       ├── show.html.twig
│       └── edit.html.twig
└── config/
    └── packages/
        ├── security.yaml
        └── doctrine.yaml
```

---

## 🛣️ Routes principales

| Route | URL | Accès |
|---|---|---|
| app_home | / | Public |
| app_post_show | /post/{id} | Public |
| app_login | /login | Public |
| app_register | /register | Public |
| app_profile | /profile | ROLE_USER |
| admin_dashboard | /admin | ROLE_ADMIN |
| admin_posts | /admin/posts | ROLE_ADMIN |
| admin_users | /admin/users | ROLE_ADMIN |
| admin_comments | /admin/comments | ROLE_ADMIN |
| admin_categories | /admin/categories | ROLE_ADMIN |

---

## 🛠️ Technologies utilisées
- **Symfony 7** — Framework PHP
- **Doctrine ORM** — Gestion de la base de données
- **Twig** — Moteur de templates
- **Bootstrap 5** — Framework CSS responsive
- **Symfony Security** — Authentification & autorisation

---


