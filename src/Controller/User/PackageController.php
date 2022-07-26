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
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
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
    public function packageShow($id,Request $request, BookRepository $bookRepository, PackageRepository $PackageRepository)
    {

        // show package by id
        $package = $PackageRepository->find($id);

        //dd($package);

        // Package not found ?
        if ($package === null) {
            throw $this->createNotFoundException('Package don\'t find');
        }

        //Get user who is connected
        $user = $this->getUser();

        //! Formulaire booking
        $book = new Book();
        $package = new Package();
        
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd('dans le if');
            // //Ajout user rattaché : TODO authentification
            // $book->setUser($user);

            // //Ajout du package associé à la réservation
            // $book->setPackages($package);
            
            // //Info par défault, status et prix (obligatoire pour valider l'ajout)
            $book->setStatus(0);
            // $book->setPrice($package->getPrice());
            $bookRepository->add($book, true);

            dd('dump de form dans le if',$form);

            //Flash Message pour le client
            $this->addFlash('success-book', 'Votre réservation est en cours de confirmation.');

            return $this->redirectToRoute('app_user_home', [], Response::HTTP_SEE_OTHER);
        }

        // dump('dump de book',$book);

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
    public function email(ManagerRegistry $doctrine)
    {
            //Envoi de mail au click du bouton réservation
            // $mailerService->send(
            //     "nouvelle réservation",
            //     "client@exemplemail.com",
            //     "contact@testqualiextra.com",
            //     "emails/email.html.twig'", 
            //     [
            //         "Nom" => $user["lastname"],
            //         "E-mail" => $user["email"],
            //         "Prix" => $package["price"],
            //         "Date de réservation" => $newBook["date"],
            //     ]
            //     );
        
        return $this->render('emails/email.html.twig');
    }
}

