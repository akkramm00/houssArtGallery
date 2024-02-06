<?php

namespace App\Controller;

use App\Repository\ColletionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    /**
     * THis controller display All collections
     *
     * @param ColletionRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/collection', name: 'collection.index', methods: ['GET'])]
    public function index(
        ColletionRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $colletion = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('pages/collection/index.html.twig', [
            'colletion' => $colletion,
        ]);
    }
}
