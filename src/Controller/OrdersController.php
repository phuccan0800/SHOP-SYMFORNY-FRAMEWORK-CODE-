<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Products;
use App\Form\OrdersType;
use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/orders")
 */
class OrdersController extends AbstractController
{
    /**
     * @Route("/", name="app_orders_index", methods={"GET"})
     */
    public function index(OrdersRepository $ordersRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $products = $entityManager->getRepository(Products::class)->findAll();
        $orders = $entityManager->getRepository(Orders::class)->findAll();
        return $this->render('orders/index.html.twig', [
            'orders' => $orders,
            'products' => $products,
            
        ]);
    }

    /**
     * @Route("/new_order", name="app_orders_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OrdersRepository $ordersRepository): Response
    {
        $query = $request->query->get('q');
        $products = [];
        if ($query) {
            $repository = $this->getDoctrine()->getRepository(Products::class);
            $products = $repository->createQueryBuilder('p')
                ->where('p.id LIKE :query')
                ->setParameter('query', '%' . $query . '%')
                ->getQuery()
                ->getResult();
        }
        $orders = new Orders();
        $form = $this->createForm(OrdersType::class, $orders);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ordersRepository->add($orders, true);

            return $this->redirectToRoute('app_orders_index', [], Response::HTTP_SEE_OTHER);
        }
        $entityManager = $this->getDoctrine()->getManager();

        if ($request->isMethod('post')) {
            // Lấy thông tin từ request
            $productId = $request->request->get('product_id');
            $qty = $request->request->get('qty');
            $fullname = $request->request->get('fullname');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $address = $request->request->get('address');

            // Tính giá sản phẩm
            $product = $entityManager->getRepository(Products::class)->find($productId);
            $price = $product->getPrice() * $qty;

            // Tạo đối tượng Order
            $order = new Orders();
            $order->setProducts($product);
            $order->setQty($qty);
            $order->setPrice($price);
            $order->setFullname($fullname);
            $order->setEmail($email);
            $order->setPhone($phone);
            $order->setAddress($address);
            $order->setDate(new \DateTime());

            // Lưu đối tượng Order vào cơ sở dữ liệu
            $entityManager->persist($order);
            $entityManager->flush();

            // Chuyển hướng về trang danh sách đơn hàng
            return $this->redirectToRoute('app_orders_index');
        }
        return $this->render('orders/new.html.twig', [
            'products' => $products,
            'orders' => $orders,
            'form' => $form,
        ]);
    }

     /**
     * @Route("/find_orders", name="find_orders", methods={"GET"})
     */
    public function find(Request $request): Response
    {
        $query = $request->query->get('q'); // lấy giá trị của tham số q trên URL
        $orders = [];
        if ($query) {
            $repository = $this->getDoctrine()->getRepository(Orders::class);
            $orders = $repository->createQueryBuilder('o')
                ->where('o.phone LIKE :query')
                ->setParameter('query', '%' . $query . '%')
                ->getQuery()
                ->getResult();
        }
        return $this->render('/orders/show.html.twig', [
            'query' => $query,
            'orders' => $orders,
        ]);
    }
}
