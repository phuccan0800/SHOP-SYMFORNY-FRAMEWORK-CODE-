<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Admin;
use App\Entity\Categories;
use App\Entity\Customers;
use App\Entity\Products;
use App\Entity\Orders;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="admin")
     */
    public function index(): Response
    {
        # this line is deny access from ROLE_USER 
            # If they haven't log in when go to /route they will be required log in
            # If they logged in but they are not admin -> Error Access Denied
           // $this->denyAccessUnlessGranted('ROLE_ADMIN');
            
            return parent::index();

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ADMIN');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Admnin', 'fas fa-tag', Admin::class);
        yield MenuItem::linkToCrud('Customers', 'fas fa-tag', Customers::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tag', Categories::class); 
        yield MenuItem::linkToCrud('Products', 'fas fa-tag', Products::class); 
        yield MenuItem::linkToCrud('Orders', 'fas fa-tag', Orders::class);
    }
}
