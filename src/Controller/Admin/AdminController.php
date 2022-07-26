<?php

namespace App\Controller\Admin;

use App\Entity\Establishment;
use App\Form\EstablishmentType;
use App\Repository\BookRepository;
use App\Repository\EstablishmentRepository;
use App\Repository\UserRepository;
use App\Services\Geocodage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * 
 * @IsGranted("ROLE_ADMIN")
 * 
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_home")
     */
    public function home(EstablishmentRepository $establishmentRepository, UserRepository $userRepository, BookRepository $bookRepository): Response
    {
        $establishmentsList = $establishmentRepository->findBy([], ['name' => 'ASC']);

        $usersList = $userRepository->findByRoles('USER');
        $prosList = $userRepository->findByRoles('PRO');
       
        $booksList = $bookRepository->findBy([], ['status' => 'ASC']);

        return $this->render('admin/home.html.twig', [
            'establishmentsList' => $establishmentsList,
            'prosList' => $prosList,
            'usersList' => $usersList,
            'booksList' => $booksList,
        ]);
    }

    /**
     * @Route("/bonnes-adresses", name="app_admin_establishment_new", methods={"GET", "POST"})
     */
    public function addResto(Request $request, EstablishmentRepository $establishmentRepository, Geocodage $geocodage): Response
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

            return $this->redirectToRoute('app_admin_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/establishment/addResto.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/bonnes-adresses/{id}", name="app_admin_establishment_edit", methods={"GET", "POST"})
     */
    public function updateResto(Request $request, Establishment $establishment, EstablishmentRepository $establishmentRepository): Response
    {
        $form = $this->createForm(EstablishmentType::class, $establishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $establishmentRepository->add($establishment, true);

            return $this->redirectToRoute('app_admin_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('establishment/admin/updateResto.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/bonnes-adresses/delete/{id}", name="app_admin_establishment_delete", methods={"POST"})
     */
    public function delete(Request $request, Establishment $establishment, EstablishmentRepository $establishmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$establishment->getId(), $request->request->get('_token'))) {
            $establishmentRepository->remove($establishment, true);
        }

        return $this->redirectToRoute('app_admin_home', [], Response::HTTP_SEE_OTHER);
    }
}
