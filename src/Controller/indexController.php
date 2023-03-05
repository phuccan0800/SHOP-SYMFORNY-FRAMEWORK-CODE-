<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\indexRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("")
 */
class indexController extends AbstractController
{
    /**
     * @Route("/", name="index_index", methods={"GET"})
     */
    public function index(indexRepository $indexRepository): Response
    {
        return $this->render('index.html.twig', [
            'products' => $indexRepository->findAll(),
        ]);
    }



}
