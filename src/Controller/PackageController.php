<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Establishment;
use App\Entity\Package;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends AbstractController
{






    

    /**
     * Show one package by id
     * 
     * @Route("/packages/{id}", name="app_package-show", requirements={"id"="\d+"}, methods={"GET"})
     *
     *  @param [type] $id
     */
    public function packageShow($id, ManagerRegistry $doctrine)
    {
        // Alternative pour accéder au Repository de l'entité Post on se sert de ManagerRegistry pour récupéré le repository
        $PackageRepository = $doctrine->getRepository(Package::class);

        $package = $PackageRepository->find($id);
        
        // Post not found ?
        if ($package === null) {
            throw $this->createNotFoundException('Package don\'t find');
        }

        return $this->render('User/package/packageShow.html.twig', [
            'package' => $package,
            
        ]);
    }

    /**
     * @Route("/packages/{id}", name="app_package-book", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function book(ManagerRegistry $doctrine, Request $request): void
    {
        $newBook = new Book();

        $form = $this->createFormBuilder($newBook);
        $form = $form->add('lastname', TextType::class);
        $form = $form->add('firstname', TextType::class);
        $form = $form->add('email', EmailType::class);
        $form = $form->add('publishedAt', DateTimeType::class, ['input' => 'datetime_immutable',]);


        //  Envoyez tout
        $form = $form->getForm();

        // Le Form inspecte la Requête
        $form->handleRequest($request);
        // ET remplit le l'instance de Post contenue dans.. $newPost
            
        // traitement du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // On va faire appel au Manager de Doctrine
            $entityManager = $doctrine->getManager();
            $entityManager->persist($newBook);
            $entityManager->flush();

            // On redirige vers la liste
        //     return $this->redirectToRoute();
        // }

        
    }
}
