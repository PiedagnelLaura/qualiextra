<?php

namespace App\Controller;

use App\Entity\Establishment;
use App\Form\EstablishmentType;
use App\Repository\EstablishmentRepository;
use App\Services\Geocodage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EstablishmentController extends AbstractController
{
    /**
     * @Route("/business/establishments", name="app_establishments-pro", methods={"GET"})
     */
    public function index(EstablishmentRepository $establishmentRepository): Response
    {
        // /** @var \App\Entity\User $user */
        // $user = $this->getUser();
        
        // $proConnected = $user->getEstablishments();

        return $this->render('establishment-pro/establishments-pro.html.twig', [
            'establishments' => $establishmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/business/establishments/new", name="app_establishment_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EstablishmentRepository $establishmentRepository, Geocodage $geocodage): Response
    {
        $establishment = new Establishment();
        $form = $this->createForm(EstablishmentType::class, $establishment);
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

            return $this->redirectToRoute('app_establishments-pro', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('establishment-pro/new.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }

    
    /**
     * @Route("/business/establishments/{id}", name="app_establishment_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Establishment $establishment, EstablishmentRepository $establishmentRepository, Geocodage $geocodage): Response
    {
        $form = $this->createForm(EstablishmentType::class, $establishment);
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


            return $this->redirectToRoute('app_establishments-pro', [], Response::HTTP_SEE_OTHER);
        }

        
        return $this->renderForm('establishment-pro/edit.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/business/establishments/{id}/delete", name="app_establishment_delete", methods={"POST"})
     */
    public function delete(Request $request, Establishment $establishment, EstablishmentRepository $establishmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$establishment->getId(), $request->request->get('_token'))) {
            $establishmentRepository->remove($establishment, true);
        }

        return $this->redirectToRoute('app_establishments-pro', [], Response::HTTP_SEE_OTHER);
    }
}
