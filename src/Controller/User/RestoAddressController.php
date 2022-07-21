<?php

namespace App\Controller\User;

use App\Entity\Establishment;
use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\EstablishmentRepository;
use App\Repository\StyleRepository;
use App\Repository\TagRepository;
use App\Services\Geocodage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestoAddressController extends AbstractController
{
    /**
     * @Route("/bonnes-adresses", name="app_user_resto_address")
     */
    public function listResto(EstablishmentRepository $establishmentRepository, StyleRepository $styleRepository, TagRepository $tagRepository, Geocodage $geocodage): Response
    {

        $listEstablishment = $establishmentRepository->findAll();
        $listTag = $tagRepository->findAll();
        $listStyle = $styleRepository->findAll();
      
        $coordinatesEstablishments = [];
        for ($i=0;$i<count($listEstablishment);$i++)  {
            
            $establishment = $listEstablishment[$i];
            $establishmentAdress = $establishment->getAddress();
            
            $coordinates = $geocodage->geocoding($establishmentAdress);
            
            $coordinatesEstablishments[] = $coordinates;
            
        }     
       //dd($coordinatesEstablishments);
        
        
        return $this->render('user/resto_address/index.html.twig', [
            'listEstablishment' => $listEstablishment,
            'listTag' => $listTag,
            'listStyle' => $listStyle,
            'coordinatesEstablishments'=>$coordinatesEstablishments
        ]);
    }
}
