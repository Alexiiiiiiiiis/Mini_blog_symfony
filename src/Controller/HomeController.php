<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        PaginatorInterface $paginator
    ): Response {
        $search = $request->query->get('q');
        $categoryId = $request->query->get('category');

        // Récupérer la query (pas les résultats)
        $query = $postRepository->createQueryBuilder('p')
            ->where('p.publishedAt IS NOT NULL')
            ->orderBy('p.publishedAt', 'DESC');

        // Filtrer par recherche
        if ($search) {
            $query->andWhere('p.title LIKE :search OR p.content LIKE :search')
                  ->setParameter('search', '%' . $search . '%');
        }

        // Filtrer par catégorie
        if ($categoryId) {
            $query->andWhere('p.category = :category')
                  ->setParameter('category', $categoryId);
        }

        // Pagination
        $posts = $paginator->paginate(
            $query->getQuery(),
            $request->query->getInt('page', 1), // Page courante
            6 // Nombre d'articles par page
        );

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'categories' => $categoryRepository->findAll(),
            'search' => $search,
            'currentCategory' => $categoryId,
        ]);
    }
}