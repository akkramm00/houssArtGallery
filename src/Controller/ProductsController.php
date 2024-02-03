<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products', methods: ['GET'])]
    public function index(
        ProductsRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $products = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/products/index.html.twig', [
            'products' => $products
        ]);
    }
}
