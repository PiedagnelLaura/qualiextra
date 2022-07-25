<?php

namespace App\Controller\User;

use App\Entity\Book;
use App\Entity\Establishment;
use App\Entity\Package;
use App\Entity\User;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Services\MailerService;
use App\Form\BookType;


/**
 * 
 */
class PackageController extends AbstractController
{


    /**
     * Show one package by id
     *
     * @Route("/packages/{id}", name="app_user_package_show", requirements={"id"="\d+"}, methods={"GET"})
     *
     *  @param [type] $id
     */
    public function packageShow($id, ManagerRegistry $doctrine)
    {
        // Alternative for access Repository of entity Package we manage with ManagerRegistry for grib the repository
        $PackageRepository = $doctrine->getRepository(Package::class);
        

        // show package by id
        $package = $PackageRepository->find($id);
        
        // Package not found ?
        if ($package === null) {
            throw $this->createNotFoundException('Package don\'t find');
        }
        // dd($_SESSION);
        return $this->render('User/packageShow.html.twig', [
            'package' => $package,
        ]);
    }

    /**
     * Méthode qui permet d'ajouter une réservation 
     * 
     * @Route("/packages/{id}", name="app_package-book", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function book(int $id,
                        ManagerRegistry $doctrine,
                        Request $request, 
                        Package $package, 
                        SerializerInterface $serializer,
                        MailerService $mailerService): JsonResponse
    {
        //TODO : Après avoir fait le formulaire d'inscription
        //Récupérer l'utilisateur connecté
        $userRepository = $doctrine->getRepository(User::class);
        dd($userRepository);

        //instanciation de book
        $newBook = new Book();

        $user = new User();

        $form = $this->createForm(BookType::class, $newBook);
        $form->handleRequest($request);
        dd('ici');

        if ($form->isSubmitted() && $form->isValid()) {

            //Ajout user rattaché : TODO authentification
            $newBook->setUser($user);
            //Ajout du package associé à la réservation
            $newBook->setPackages($package);
            //Info par défault, status et prix (obligatoire pour valider l'ajout)
            $newBook->setStatus(0);
            $newBook->setPrice($package->getPrice());
            
            $form->add($newBook, true);

            $data = $form->getData();
            dd($data);

            $mailerService->send(
                "nouvelle réservation",
                "client@exemplemail.com",
                "contact@testqualiextra.com",
                "emails/email.html.twig'", 
                [
                    "Nom" => $user["lastname"],
                    "E-mail" => $user["email"],
                    "Date de réservation" => $newBook["date"],
                ]

                );

            

            dd($form);
            return $this->redirectToRoute('app_user_home', [], Response::HTTP_SEE_OTHER);
        }


        //TODO Envoi du mail à l'admin et prestataire 
        
        //Flash Message pour le client
        $this->addFlash('success-book', 'Votre réservation est en cours de confirmation.');

        //envoi au format JSON info de la réservation
        // return $this->json(['book' => json_decode($serializer->serialize($newBook, 'json', ['groups' => ['normal']]))]);

        // redirection vers la page 
        // return $this->redirectToRoute('app_user_home', [], Response::HTTP_SEE_OTHER);
        return $this->renderForm('User/packageShow.html.twig', ["form" => $form]);
    }


}