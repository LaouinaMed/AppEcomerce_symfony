<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/users' , name : 'admin_users_')]
class UsersController extends AbstractController
{
    #[Route('/' , name : 'index')]
    public function index(): HttpFoundationResponse
    {
        return $this->render('admin/users/index.html.twig');
    }
}