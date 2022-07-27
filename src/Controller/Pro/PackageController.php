<?php

namespace App\Controller\Pro;

use App\Entity\Package;
use App\Form\PackageType;
use App\Form\EditPackageType;
use App\Repository\BookRepository;
use App\Repository\EstablishmentRepository;
use App\Repository\PackageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PackageController extends AbstractController
{
    /**
     * Add a new package in the BDD
     * 
     * @Route("/business/packages", name="app_pro_new_package", methods={"GET", "POST"})
     */
    public function addPackage(Request $request, PackageRepository $packageRepository): Response
    {
        $package = new Package();
        $form = $this->createForm(PackageType::class, $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packageRepository->add($package, true);

            return $this->redirectToRoute('app_pro_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('package/new.html.twig', [
            'package' => $package,
            'form' => $form,
        ]);
    }


    /**
     * Update a package in the BDD
     * 
     * @Route("/business/packages/{id}", name="app_pro_update_package", methods={"GET", "POST"})
     */
    public function updatePackage(Request $request, Package $package, PackageRepository $packageRepository): Response
    {
        $form = $this->createForm(EditPackageType::class, $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packageRepository->add($package, true);

            return $this->redirectToRoute('app_pro_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('package/edit.html.twig', [
            'package' => $package,
            'form' => $form,
        ]);
    }

    /**
     * Delete a package in the BDD
     * 
     * @Route("/business/packages/{id}/delete", name="app_pro_delete_package", methods={"POST"})
     */
    public function deletePackage(Request $request, Package $package, PackageRepository $packageRepository): Response
    {

        if ($this->isCsrfTokenValid('delete'.$package->getId(), $request->request->get('_token'))) {
            $packageRepository->remove($package, true);
        }

        return $this->redirectToRoute('app_pro_home', [], Response::HTTP_SEE_OTHER);
    }
    
    /**
    * Browse all the reservation owned by the user
    *
    * @Route("/business/books", name="app_pro_reservations")
    */
    public function showBook ( EstablishmentRepository $establishmentRepository )
    {
         /** @var \App\Entity\User $user */
         $user = $this->getUser();
        
        // we retrieve his establishments
        $listEstablishment = $establishmentRepository->findByUser($user);
        
        return $this->render('Pro/reservations_list.html.twig', [
            'listEstablishment' => $listEstablishment,
        ]);
    }

    /**
    * confirmed the book
    * update the entity status in the BDD 
    * 
    * @Route("/business/books/validated/{id}", name="app_pro_update_book_validated")
    */
    public function bookValidate (BookRepository $bookRepository, ManagerRegistry $doctrine)
    {
        //give the book'id present in the URL
         $infos = $_SERVER['PATH_INFO'];
         $id= substr($infos,-2);
       
        //we find the entity book in our BDD
        $book = $bookRepository->find($id);
        
        //Set new value (1=book validate)
        $book->setStatus(1);

        //Save in the BDD
        $entityManager =$doctrine->getManager();
        $entityManager->flush();


        //TODO:add a flash message in the current page
        //TODO:add flash message to the customer 


        return $this->redirectToRoute('app_pro_reservations', [], Response::HTTP_SEE_OTHER);
    }

    /**
    * 
    *Cancel the book
    *
    * @Route("/business/books/cancelled/{id}", name="app_pro_update_book_cancelled")
    */
    public function bookCancel (BookRepository $bookRepository, ManagerRegistry $doctrine)
    {
        $infos = $_SERVER['PATH_INFO'];
        $id= substr($infos, -2);
        
        //we find the entity book in our BDD
        $book = $bookRepository->find($id);
        
        //Set new value (2=book cancelled)
        $book->setStatus(2);

        $entityManager =$doctrine->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('app_pro_reservations', [], Response::HTTP_SEE_OTHER);
    }
}
