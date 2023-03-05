<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Categories;  
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
            'categories' => $indexRepository->findAll(),
            'products' => $indexRepository->findAll(),
        ]);
    }
    /**
     * @Route("find", name="find_index", methods={"GET"})
     */
    public function find(Request $request): Response
    {
        $query = $request->query->get('q'); // lấy giá trị của tham số q trên URL

        $products = [];
        if ($query) {
            $repository = $this->getDoctrine()->getRepository(Products::class);
            $products = $repository->createQueryBuilder('p')
                ->where('p.name LIKE :query')
                ->setParameter('query', '%' . $query . '%')
                ->getQuery()
                ->getResult();
        }

        return $this->render('index.html.twig', [
            'query' => $query,
            'products' => $products,
        ]);
    }

}
