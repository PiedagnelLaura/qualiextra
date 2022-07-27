<?php

namespace App\Controller\User;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Show package list with filter by type
     * 
     * @Route("/", name="app_user_home", methods={"GET"})
     */
    public function home(TypeRepository $typeRepository): Response
    {  
        $typeList = $typeRepository->findAll();
        
        return $this->render(
            'User/home.html.twig', 
            [
                'typeList' => $typeList,
            ]
        );
    }

    /**
     * Show CGV
     *
     * @Route("/CGV", name="app_user_cgv", methods={"GET"})
     */
    public function cgv() {
        return $this->render('User/cgv.html.twig');
    }
}
