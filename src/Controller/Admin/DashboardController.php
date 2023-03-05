<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        {  # this line is deny access from ROLE_USER 
            # If they haven't log in when go to /route they will be required log in
            # If they logged in but they are not admin -> Error Access Denied
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            
            return parent::index();
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ADMIN');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Customers', 'fas fa-tag', Customers::Class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tag', Categories::Class); 
        yield MenuItem::linkToCrud('Products', 'fas fa-tag', Products::Class); 
        yield MenuItem::linkToCrud('Orders', 'fas fa-tag', Orders::Class);
    }
}
