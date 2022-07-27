<?php

namespace App\Controller\User;

use App\Entity\Book;
use App\Entity\Establishment;
use App\Entity\Package;
use App\Entity\User;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\EstablishmentRepository;
use App\Repository\PackageRepository;
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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;


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
    * @Route("/business/books", name="app_pro_reservations_list")
    */
    public function showBook ( EstablishmentRepository $establishmentRepository ){
        
        //we find the current User
        $email= $_SESSION['_sf2_attributes']['_security.last_username'];
        
        $user =$this->userRepository->findByEmail($email);

        // we retrieve his establishments
        $listEstablishment = $establishmentRepository->findByUser($user);
        
       

        return $this->render('Pro/reservations_list.html.twig', [
            'listEstablishment' => $listEstablishment,
          
        ]);
    }
    /**
    * @Route("/business/books/validated/{id}", name="app_pro_update_book_validated")
    */
    public function bookValidate (BookRepository $bookRepository, ManagerRegistry $doctrine){
        

         $infos = $_SERVER['PATH_INFO'];
         $id= substr($infos,-2);
       
        //we find the entity book in our BDD
        $book = $bookRepository->find($id);
        
        $book->setStatus(1);

        $entityManager =$doctrine->getManager();
        
        $entityManager->flush();
        return $this->redirectToRoute('app_pro_reservations_list', [], Response::HTTP_SEE_OTHER);
  
    }
     /**
    * @Route("/business/books/cancelled/{id}", name="app_pro_update_book_cancelled")
    */
    public function bookCancel (BookRepository $bookRepository, ManagerRegistry $doctrine){
    $infos = $_SERVER['PATH_INFO'];
    $id= substr($infos, -2);
      
    //we find the entity book in our BDD
    $book = $bookRepository->find($id);
       
    $book->setStatus(2);

    $entityManager =$doctrine->getManager();
       
    $entityManager->flush();
    return $this->redirectToRoute('app_pro_reservations_list', [], Response::HTTP_SEE_OTHER);
    }
}