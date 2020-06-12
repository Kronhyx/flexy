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
        return $this->render('index/index.html.twig', [
            'entities' => [
                'product' => $productRepository->findAll(),
                'tag'     => $tagRepository->findAll(),
            ],
        ]);
    }
}
