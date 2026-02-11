<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use App\Form\PostType;
use App\Form\CategoryType;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private PostRepository $postRepository,
        private UserRepository $userRepository,
        private CommentRepository $commentRepository,
        private CategoryRepository $categoryRepository
    ) {}

    // ─── DASHBOARD ───────────────────────────────────────────────────────────

    #[Route('', name: 'admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'totalPosts'    => count($this->postRepository->findAll()),
            'totalUsers'    => count($this->userRepository->findAll()),
            'totalComments' => count($this->commentRepository->findAll()),
            'recentPosts'   => $this->postRepository->findBy([], ['publishedAt' => 'DESC'], 5),
        ]);
    }

    // ─── POSTS ───────────────────────────────────────────────────────────────

    #[Route('/posts', name: 'admin_posts')]
    public function posts(): Response
    {
        return $this->render('admin/posts/index.html.twig', [
            'posts' => $this->postRepository->findAllOrderedByDate(),
        ]);
    }

    #[Route('/posts/new', name: 'admin_post_new')]
    public function newPost(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($this->getUser());
            $this->em->persist($post);
            $this->em->flush();
            $this->addFlash('success', 'Article créé avec succès !');
            return $this->redirectToRoute('admin_posts');
        }

        return $this->render('admin/posts/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Nouvel article',
        ]);
    }

    #[Route('/posts/{id}/edit', name: 'admin_post_edit', requirements: ['id' => '\d+'])]
    public function editPost(int $id, Request $request): Response
    {
        $post = $this->postRepository->find($id);
        if (!$post) throw $this->createNotFoundException();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Article modifié avec succès !');
            return $this->redirectToRoute('admin_posts');
        }

        return $this->render('admin/posts/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier l\'article',
            'post' => $post,
        ]);
    }

    #[Route('/posts/{id}/delete', name: 'admin_post_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function deletePost(int $id, Request $request): Response
    {
        $post = $this->postRepository->find($id);
        if (!$post) throw $this->createNotFoundException();

        if ($this->isCsrfTokenValid('delete_post_' . $id, $request->request->get('_token'))) {
            $this->em->remove($post);
            $this->em->flush();
            $this->addFlash('success', 'Article supprimé.');
        }
        return $this->redirectToRoute('admin_posts');
    }

    // ─── USERS ───────────────────────────────────────────────────────────────

    #[Route('/users', name: 'admin_users')]
    public function users(): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'users' => $this->userRepository->findAllOrderedByDate(),
        ]);
    }

    #[Route('/users/{id}/toggle', name: 'admin_user_toggle', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function toggleUser(int $id, Request $request): Response
    {
        $user = $this->userRepository->find($id);
        if (!$user) throw $this->createNotFoundException();

        if ($this->isCsrfTokenValid('toggle_user_' . $id, $request->request->get('_token'))) {
            $user->setIsActive(!$user->isActive());
            $this->em->flush();
            $status = $user->isActive() ? 'activé' : 'désactivé';
            $this->addFlash('success', "Compte utilisateur {$status}.");
        }
        return $this->redirectToRoute('admin_users');
    }

    // ─── COMMENTS ────────────────────────────────────────────────────────────

    #[Route('/comments', name: 'admin_comments')]
    public function comments(): Response
    {
        return $this->render('admin/comments/index.html.twig', [
            'comments' => $this->commentRepository->findAllOrderedByDate(),
        ]);
    }

    #[Route('/comments/{id}/toggle', name: 'admin_comment_toggle', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function toggleComment(int $id, Request $request): Response
    {
        $comment = $this->commentRepository->find($id);
        if (!$comment) throw $this->createNotFoundException();

        if ($this->isCsrfTokenValid('toggle_comment_' . $id, $request->request->get('_token'))) {
            $newStatus = $comment->getStatus() === 'approved' ? 'rejected' : 'approved';
            $comment->setStatus($newStatus);
            $this->em->flush();
            $this->addFlash('success', 'Statut du commentaire mis à jour.');
        }
        return $this->redirectToRoute('admin_comments');
    }

    #[Route('/comments/{id}/delete', name: 'admin_comment_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function deleteComment(int $id, Request $request): Response
    {
        $comment = $this->commentRepository->find($id);
        if (!$comment) throw $this->createNotFoundException();

        if ($this->isCsrfTokenValid('delete_comment_' . $id, $request->request->get('_token'))) {
            $this->em->remove($comment);
            $this->em->flush();
            $this->addFlash('success', 'Commentaire supprimé.');
        }
        return $this->redirectToRoute('admin_comments');
    }

    // ─── CATEGORIES ──────────────────────────────────────────────────────────

    #[Route('/categories', name: 'admin_categories')]
    public function categories(): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route('/categories/new', name: 'admin_category_new')]
    public function newCategory(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();
            $this->addFlash('success', 'Catégorie créée !');
            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/categories/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Nouvelle catégorie',
        ]);
    }

    #[Route('/categories/{id}/edit', name: 'admin_category_edit', requirements: ['id' => '\d+'])]
    public function editCategory(int $id, Request $request): Response
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) throw $this->createNotFoundException();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Catégorie modifiée !');
            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/categories/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier la catégorie',
        ]);
    }

    #[Route('/categories/{id}/delete', name: 'admin_category_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function deleteCategory(int $id, Request $request): Response
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) throw $this->createNotFoundException();

        if ($this->isCsrfTokenValid('delete_cat_' . $id, $request->request->get('_token'))) {
            $this->em->remove($category);
            $this->em->flush();
            $this->addFlash('success', 'Catégorie supprimée.');
        }
        return $this->redirectToRoute('admin_categories');
    }
}
