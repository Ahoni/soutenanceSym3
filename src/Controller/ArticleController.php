<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\BlogCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("blog/{slug}", name="article_blogCategory")
     */
    public function blogCategory($slug, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $blogCategory = $blogCategoryRepository->findOneBy([
            'slug' => $slug
        ]);

        if (!$blogCategory) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas !");
        }

        return $this->render('article/blogCategory.html.twig', [
            'slug' => $slug,
            'blogCategory' => $blogCategory
        ]);
    }

    /**
     * @Route("blog/{blogCategory_slug}/{slug}", name="article_show")
     */
    public function show($slug, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findOneBy([
            'slug' => $slug
        ]);

        if (!$articleRepository) {
            throw $this->createNotFoundException("L'article demandée n'existe pas !");
        }

        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}
