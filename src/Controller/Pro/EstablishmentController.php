<?php

namespace App\Controller\Pro;

use App\Entity\Establishment;
use App\Form\ProEstablishmentType;
use App\Repository\EstablishmentRepository;
use App\Services\Geocodage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * 
 * @IsGranted("ROLE_PRO")
 * 
 */
class EstablishmentController extends AbstractController
{
    /**
     * Show establishments list
     * 
     * @Route("/business/establishments", name="app_pro_establishments", methods={"GET"})
     */
    public function listStore(EstablishmentRepository $establishmentRepository): Response
    {
        // We get the connected user
         /** @var \App\Entity\User $user */
        $user = $this->getUser();
        
        // we retrieve his establishments
        $establishment = $establishmentRepository->findByUser($user);       

        return $this->render('Pro/establishments_list.html.twig', [
            'establishments' => $establishment
        ]);
    }

    /**
     * create a new entity of establishment in the database
     * 
     * @Route("/business/establishments/addStore", name="app_pro_new_establishment", methods={"GET", "POST"})
     */
    public function addStore(Request $request, EstablishmentRepository $establishmentRepository, Geocodage $geocodage): Response
    {
        $establishment = new Establishment();
        $form = $this->createForm(ProEstablishmentType::class, $establishment);

        //We are obliged to set user to link the establishment

         /** @var \App\Entity\User $user */
        $user = $this->getUser();

        //we make link between the connected professionnal and this establishements
        $establishment->setUser($user);

        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            // the address is geocoded 
            $address = $establishment->getAddress();
            $coordinates = $geocodage->geocoding($address);
            $lat = $coordinates['lat'];
            $long = $coordinates['lng'];
            $establishment->setLatitudes($lat);
            $establishment->setLongitudes($long);

            $establishmentRepository->add($establishment, true);

            $this->addFlash('success', 'L\'établissement ' . $establishment->getName() . ' a été créé ');

            return $this->redirectToRoute('app_pro_establishments', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Pro/establishment/new.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }

    /**
     * Update the current entity of store in the database
     * 
     * @Route("/business/establishments/{id}", name="app_pro_update_establishment", methods={"GET", "POST"})
     */
    public function updateStore(Request $request, Establishment $establishment, EstablishmentRepository $establishmentRepository, Geocodage $geocodage): Response
    {
        $form = $this->createForm(ProEstablishmentType::class, $establishment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // the address is geocoded 
            $address = $establishment->getAddress();
            $coordinates = $geocodage->geocoding($address);
            $lat = $coordinates['lat'];
            $long = $coordinates['lng'];
            $establishment->setLatitudes($lat);
            $establishment->setLongitudes($long);

            $establishmentRepository->add($establishment, true);

            $this->addFlash('success', 'L\'établissement ' . $establishment->getName() . ' a bien été modifié');

            return $this->redirectToRoute('app_pro_establishments', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Pro/establishment/edit.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }


    /**
     * Delete a establishment in the BDD
     * 
     * @Route("/business/establishments/{id}/delete", name="app_pro_delete_establishment", methods={"POST"})
     */
    public function delete(Request $request, Establishment $establishment, EstablishmentRepository $establishmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$establishment->getId(), $request->request->get('_token'))) {
            $establishmentRepository->remove($establishment, true);

            $this->addFlash('success', 'L\'établissement ' . $establishment->getName() . ' a été supprimé');
        }

        return $this->redirectToRoute('app_pro_establishments', [], Response::HTTP_SEE_OTHER);
    }
}
