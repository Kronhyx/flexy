<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/")
     * @param ProductRepository $productRepository
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function index(ProductRepository $productRepository, TagRepository $tagRepository): Response
    {
        //Get most used tags
        $mostUsed = $tagRepository->findMostUsed(10);

        $products = $productRepository->findAll();
        $tags = $tagRepository->findAll();

        return $this->render('index/index.html.twig', [
            'mostUsed' => $mostUsed,
            'entities' => [
                'product' => $products,
                'tag'     => $tags,
            ],
        ]);
    }
}
