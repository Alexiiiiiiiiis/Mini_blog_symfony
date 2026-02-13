<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Post;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LikeController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LikeRepository $likeRepository
    ) {}

    #[Route('/post/{id}/like', name: 'app_post_like', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function toggleLike(Post $post): JsonResponse
    {
        $user = $this->getUser();
        
        // Vérifier si l'utilisateur a déjà liké cet article
        $existingLike = $this->likeRepository->findLike($user, $post);
        
        if ($existingLike) {
            // Unlike : supprimer le like
            $this->em->remove($existingLike);
            $this->em->flush();
            
            return $this->json([
                'success' => true,
                'liked' => false,
                'likesCount' => $post->getLikesCount(),
                'message' => 'Like retiré'
            ]);
        } else {
            // Like : ajouter un nouveau like
            $like = new Like();
            $like->setUser($user);
            $like->setPost($post);
            
            $this->em->persist($like);
            $this->em->flush();
            
            return $this->json([
                'success' => true,
                'liked' => true,
                'likesCount' => $post->getLikesCount(),
                'message' => 'Article liké !'
            ]);
        }
    }
}