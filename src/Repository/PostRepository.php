<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findAllOrderedByDate(): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.author', 'a')
            ->leftJoin('p.category', 'c')
            ->addSelect('a', 'c')
            ->orderBy('p.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByCategory(int $categoryId): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->where('c.id = :catId')
            ->setParameter('catId', $categoryId)
            ->orderBy('p.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function search(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.title LIKE :q OR p.content LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('p.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Récupérer tous les posts likés par un utilisateur
     */
    public function findLikedPostsByUser(User $user): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.likes', 'l')
            ->where('l.user = :user')
            ->setParameter('user', $user)
            ->orderBy('l.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}