<?php

namespace App\Controller\User;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Form\BookType;
use App\Entity\Establishment;
use App\Entity\Package;
use App\Repository\PackageRepository;
use App\Entity\User;
use App\Repository\UserRepository;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use App\Services\MailerService;


/**
 * 
 */
class PackageController extends AbstractController
{

 

    /**
     * Show one package by id
     *
     * @Route("/packages/{id}", name="app_user_package_show", requirements={"id"="\d+"}, methods={"GET", "POST"})
     *
     *  @param [type] $id
     */
    public function packageShow($id,Request $request, BookRepository $bookRepository, PackageRepository $PackageRepository, UserRepository $userRepository)
    {

        // show package by id
        $package = $PackageRepository->find($id);


        // Package not found ?
        if ($package === null) {
            throw $this->createNotFoundException('Package don\'t find');
        }

        //Get user who is connected
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        //! Formulaire booking
        $book = new Book();
        
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $book->setStatus(0);
            $book->setUser($user);
            $book->setPackages($package);
            $book->setPrice($package->getPrice());
            //dd($book);
            $bookRepository->add($book, true);



            //Flash Message pour le client
            $this->addFlash('success-book', 'Votre réservation est en cours de confirmation.');

            return $this->redirectToRoute('app_user_home', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('User/packageShow.html.twig', [
            'package' => $package,
            'form' => $form,
            'book' => $book,
        ]);



    }



        /**
     * Show email
     *
     * @Route("/email", name="app_mail", methods={"GET"})
     *
     *  
     */
    public function email($id,Request $request, MailerService $mailerService, PackageRepository $packageRepository)
    {

        $package = $packageRepository->find($id);

        $book = new Book();

        //Get user who is connected
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dataFrom = $form->getData();
            dd('dd de form email',$form);

            //Envoi de mail au click du bouton réservation
            $mailerService->send(
                "nouvelle réservation",
                "client@exemplemail.com",
                "contact@testqualiextra.com",
                "emails/email.html.twig'",
                [
                    "Nom" => $user["lastname"],
                    "E-mail" => $user["email"],
                    "Prix" => $package["price"],
                    "Date de réservation" => $book["date"],
                ]
            );


            //Flash Message pour le client
            $this->addFlash('success-book', 'Votre message à bien été envoyé.');

            dd('dd de mailerservice',$mailerService);
        }
        
        return $this->render('emails/email.html.twig');
    }
}

