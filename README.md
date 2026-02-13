# 📝 Projet Blog Symfony

Un blog complet développé avec **Symfony 7**, **Bootstrap 5** et **Doctrine ORM**, avec gestion des rôles (Admin, Utilisateur, Visiteur).

---

## ✨ Fonctionnalités

### 👥 Rôles utilisateurs

| Fonctionnalité | Visiteur | Utilisateur | Admin |
|---|:---:|:---:|:---:|
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
User                Post                Comment             Category
────────────        ────────────        ────────────        ────────────
id                  id                  id                  id
email               title               content             name
password            content             createdAt           description
roles               publishedAt         status
firstName           picture             author (User)
lastName            author (User)       post (Post)
profilePicture      category (Cat)
createdAt           comments []
updatedAt
isActive
posts []
comments []
```

---

## ⚙️ Installation

### 📋 Prérequis

- **PHP 8.2+**
- **Composer**
- **MySQL 8.0+** ou MariaDB
- **Symfony CLI**

### 🚀 Étapes d'installation

```bash
# 1. Cloner le projet
git clone https://github.com/votre-username/symfony-blog.git
cd symfony-blog

# 2. Installer les dépendances
composer install

# 3. Configurer la base de données
cp .env .env.local
# Éditer .env.local et modifier DATABASE_URL :
# DATABASE_URL="mysql://root:motdepasse@127.0.0.1:3306/symfony_blog"

# 4. Créer la base de données
php bin/console doctrine:database:create

# 5. Exécuter les migrations
php bin/console doctrine:migrations:migrate

# 6. Charger les données de test
php bin/console doctrine:fixtures:load

# 7. Lancer le serveur
symfony serve
```

Le site sera accessible sur **http://127.0.0.1:8000**

---

## 🔑 Comptes de test (après fixtures)

| Email | Mot de passe | Rôle | Nom |
|---|---|---|---|
| admin@blog.com | `admin123` | ROLE_ADMIN | Admin Blog |
| alexis.rodrigues95140@gmail.com | `admin123` | ROLE_ADMIN | Alexis Rodrigues |
| user@blog.com | `user123` | ROLE_USER | Jean Dupont |
| prof@blog.com | `user321` | ROLE_USER | Hugo Lemoine |

---

## 📊 Données de test

Les fixtures créent automatiquement :

- ✅ **4 utilisateurs** (2 admins + 2 utilisateurs standards)
- ✅ **6 catégories** (Technologie, Symfony, PHP, Design, Actualités, Gaming)
- ✅ **8 articles** avec images et contenu complet
- ✅ **20 commentaires** répartis sur les articles

---

## 🗂️ Structure du projet

```
symfony-blog/
├── src/
│   ├── Controller/
│   │   ├── AdminController.php          # Gestion admin complète
│   │   ├── HomeController.php           # Page d'accueil avec recherche
│   │   ├── BlogController.php           # Pages publiques blog
│   │   ├── SecurityController.php       # Login / Register
│   │   └── ProfileController.php        # Profil utilisateur
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
│   ├── Repository/                      # Repositories Doctrine
│   ├── Security/
│   │   └── LoginFormAuthenticator.php
│   └── DataFixtures/
│       ├── AdminFixtures.php            # Comptes administrateurs
│       ├── UserFixtures.php             # Utilisateurs standards
│       ├── CategoryFixtures.php         # 6 catégories
│       ├── PostFixtures.php             # 8 articles
│       └── CommentFixtures.php          # 20 commentaires
├── templates/
│   ├── base.html.twig
│   ├── home/
│   │   └── index.html.twig              # Page d'accueil + recherche + pagination
│   ├── blog/
│   │   ├── index.html.twig              # Liste des articles + sidebar
│   │   └── show.html.twig               # Détail article + commentaires
│   ├── admin/
│   │   ├── base.html.twig               # Layout admin avec sidebar
│   │   ├── dashboard.html.twig          # Tableau de bord
│   │   ├── posts/                       # CRUD articles
│   │   ├── users/                       # Gestion utilisateurs
│   │   ├── comments/                    # Modération commentaires
│   │   └── categories/                  # CRUD catégories
│   ├── security/
│   │   └── login.html.twig
│   ├── registration/
│   │   └── register.html.twig
│   ├── profile/
│   │   ├── show.html.twig
│   │   └── edit.html.twig
│   └── components/
│       └── pagination.html.twig         # Composant pagination réutilisable
└── config/
    └── packages/
        ├── security.yaml
        ├── doctrine.yaml
        ├── knp_paginator.yaml           # Configuration pagination
        └── translation.yaml             # Locale FR
```

---

## 🛣️ Routes principales

| Route | URL | Accès |
|---|---|---|
| `app_home` | `/` | Public |
| `app_blog` | `/blog` | Public |
| `app_post_show` | `/post/{id}` | Public |
| `app_login` | `/login` | Public |
| `app_register` | `/register` | Public |
| `app_profile` | `/profile` | ROLE_USER |
| `admin_dashboard` | `/admin` | ROLE_ADMIN |
| `admin_posts` | `/admin/posts` | ROLE_ADMIN |
| `admin_users` | `/admin/users` | ROLE_ADMIN |
| `admin_comments` | `/admin/comments` | ROLE_ADMIN |
| `admin_categories` | `/admin/categories` | ROLE_ADMIN |

---

## 🛠️ Technologies utilisées

- **Symfony 7** — Framework PHP
- **Doctrine ORM** — Gestion de la base de données
- **Twig** — Moteur de templates
- **Bootstrap 5** — Framework CSS responsive
- **Bootstrap Icons** — Bibliothèque d'icônes
- **Symfony Security** — Authentification & autorisation
- **KnpPaginatorBundle** — Pagination des résultats

---

## 🚀 Fonctionnalités avancées

### 🔍 Recherche

- Recherche par titre et contenu des articles
- Recherche par catégorie
- Pagination intégrée aux résultats

### 📄 Pagination

- 6 articles par page sur la page d'accueil
- 5 articles par page dans la section blog
- Pagination personnalisée avec Bootstrap 5

### 🎨 Interface responsive

- Design moderne et épuré
- Sidebar avec catégories et articles récents
- Cards Bootstrap pour l'affichage des articles
- Interface d'administration complète avec modales de confirmation

### 🔐 Sécurité

- Hashage des mots de passe avec Bcrypt
- Protection CSRF sur tous les formulaires
- Système de rôles (ROLE_USER, ROLE_ADMIN)
- Modération des commentaires (statut approved/pending)

