<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository,
        private CategoryRepository $categoryRepository,
        private EntityManagerInterface $em
    ) {}



    #[Route('/post/{id}', name: 'app_post_show', requirements: ['id' => '\d+'])]
    public function show(int $id, Request $request): Response
    {
        $post = $this->postRepository->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Article introuvable.');
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->denyAccessUnlessGranted('ROLE_USER');

            $comment->setAuthor($this->getUser());
            $comment->setPost($post);
            $this->em->persist($comment);
            $this->em->flush();

            $this->addFlash('success', 'En attente de validation de votre commentaire !');
            return $this->redirectToRoute('app_post_show', ['id' => $id]);
        }

        return $this->render('blog/show.html.twig', [
            'post' => $post,
            'commentForm' => $form->createView(),
            'categories' => $this->categoryRepository->findAll(),
            'currentCategory' => null,
        ]);
    }
}
