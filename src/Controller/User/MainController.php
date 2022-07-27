<?php

namespace App\Controller\User;

use App\Repository\BookRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Show package list with filter by type
     * 
     * @Route("/", name="app_user_home", methods={"GET"})
     */
    public function home(TypeRepository $typeRepository, BookRepository $bookRepository): Response
    {  
        $typeList = $typeRepository->findAll();

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if($user!==null) {
        // Get user booking with user Id
        $books = $bookRepository->findByUser($user);
        // For display the flash message to each package which are booked
       foreach($books as $book) {
            //If the message status = 0 so we display the response from the pro
            if($book->isMessageStatus() ===false) {
                //If the pro valid the book => the book is confirmed
                if($book->getStatus() === 1) {
                    $this->addFlash('success', 'Votre réservation est confirmé');
                   
                }//If the pro reject the book => the book is cancelled
                else if ($book->getStatus() === 2) {
                    $this->addFlash('warning', 'Votre réservation a été refusée');
                }
            }
        }
        }
        
        


        return $this->render(
            'User/home.html.twig', 
            [
                'typeList' => $typeList, 'books'=>$books
            ]
        );
    }

    /**
     * Show CGV
     *
     * @Route("/CGV", name="app_user_cgv", methods={"GET"})
     */
    public function cgv() {
        return $this->render('User/cgv.html.twig');
    }
}
