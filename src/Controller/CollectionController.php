<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    #[Route('/collection', name: 'collection.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/collection/index.html.twig', [
            'controller_name' => 'CollectionControlllerController',
        ]);
    }
}
