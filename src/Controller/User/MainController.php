<?php

namespace App\Controller\User;

use App\Repository\PackageRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_user_home", methods={"GET"})
     */
    public function home(TypeRepository $typeRepository): Response
    {  
        $typeList = $typeRepository->findAll();
        

        return $this->render(
            'User/main/home.html.twig', 
            [
                'typeList' => $typeList,
            ]
        );
    }
}
