<?php

namespace App\Controller\User;

use App\Entity\Establishment;
use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\EstablishmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestoAddressController extends AbstractController
{
    /**
     * @Route("/bonnes-adresses", name="app_user_resto_address")
     */
    public function listResto(EstablishmentRepository $establishmentRepository ): Response
    {
        
        $listEstablishment = $establishmentRepository->findAll();
        
        return $this->render('user/resto_address/index.html.twig', ['listEstablishment'=>$listEstablishment]);
    }
}
