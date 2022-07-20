<?php

namespace App\Controller;

use App\Entity\Establishment;
use App\Entity\Package;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends AbstractController
{






    

    /**
     * Show one package by id
     * 
     * @Route("/packages/{id}", name="app_package-show", requirements={"id"="\d+"})
     *
     *  @param [type] $id
     */
    public function packageShow($id, ManagerRegistry $doctrine)
    {
        // Alternative pour accéder au Repository de l'entité Post on se sert de ManagerRegistry pour récupéré le repository
        $PackageRepository = $doctrine->getRepository(Package::class);
        $EstablishmentRepository = $doctrine->getRepository(Establishment::class);

        $package = $PackageRepository->find($id);
        $establishment = $EstablishmentRepository->find($id);

        // Post not found ?
        if ($package === null) {
            throw $this->createNotFoundException('Package don\'t find');
        }

        return $this->render('User/package/packageShow.html.twig', [
            'package' => $package,
            'establishment' => $establishment
        ]);
    }
}
