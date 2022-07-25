<?php

namespace App\Controller\Pro;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/business", name="app_pro_home")
     */
    public function home(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $myEstablishment = $user->getEstablishments();

        return $this->render('Pro/index.html.twig', [

            'establishmentList' => $myEstablishment,
        ]);
    }
}
