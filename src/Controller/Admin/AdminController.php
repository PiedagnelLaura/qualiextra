<?php

namespace App\Controller\Admin;

use App\Repository\BookRepository;
use App\Repository\EstablishmentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin_home")
     */
    public function home(EstablishmentRepository $establishmentRepository, UserRepository $userRepository, BookRepository $bookRepository): Response
    {
        $establishmentList = $establishmentRepository->findAll();

        $userList = $userRepository->findAll();
       
        $bookList = $bookRepository->findAll();

        return $this->render('admin/home.html.twig', [
            'establishmentList' => $establishmentList,
            'userList' => $userList,
            'bookList' => $bookList,
        ]);
    }
}
