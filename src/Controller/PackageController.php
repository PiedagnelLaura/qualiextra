<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Establishment;
use App\Entity\Package;
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
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
     * Méthode qui permet d'ajouter une réservation 
     * 
     * @Route("/packages/{id}", name="app_package-book", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function book(ManagerRegistry $doctrine, Request $request, UserRepository $userRepository, Package $package, SerializerInterface $serializer): JsonResponse
    {
        //TODO : Après avoir fait le formulaire d'inscription
        //Récupérer l'utilisateur connecté
        //Vérifier qu'il n'a pas fait plusieurs réservation avec ce même package à la même date

        //Cela sert à récupérer l'utilisateur (pour le moment je l'ai mis en dur car pas d'authentification faite et pour pouvoir réserver j'ai besoin de l'id_user)
        $newUser = $userRepository->find(1);

        //J'instancie une nouvelle réservation
        $newBook = new Book();

        //Récupère ce qu'il y a dans POST
        $data = $request->toArray();

        //*On set les éléments obligatoires pour ajouter notre réservation en BDD

        //Ajout de la date qu'on viens de récup 
        $newBook->setDate(\DateTime::createFromFormat('Y-m-d', $data['date']));
        //Ajout user rattaché : TODO authentification
        $newBook->setUser($newUser);
        //Ajout du package associé à la réservation
        $newBook->setPackages($package);
        //Info par défault, status et prix (obligatoire pour valider l'ajout)
        $newBook->setStatus(0);
        $newBook->setPrice($package->getPrice());
        


        //Push en BDD
        $entityManager = $doctrine->getManager();
        $entityManager->persist($newBook);
        $entityManager->flush();

        //TODO Envoi du mail à l'admin et prestataire 
        
        //Flash Message pour le client
        $this->addFlash('success-book', 'Votre réservation est en cours de confirmation.');

        //envoi au format JSON info de la réservation
        return $this->json(['book' => json_decode($serializer->serialize($newBook, 'json', ['groups' => ['normal']]))]);
    }

    
}