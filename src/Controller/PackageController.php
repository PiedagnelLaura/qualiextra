<?php

namespace App\Controller;

use App\Entity\Package;
use App\Form\PackageType;
use App\Repository\PackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/package")
 */
class PackageController extends AbstractController
{
    /**
     * @Route("/", name="app_package_index", methods={"GET"})
     */
    public function index(PackageRepository $packageRepository): Response
    {
        return $this->render('package/index.html.twig', [
            'packages' => $packageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_package_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PackageRepository $packageRepository): Response
    {
        $package = new Package();
        $form = $this->createForm(PackageType::class, $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packageRepository->add($package, true);

            return $this->redirectToRoute('app_package_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('package/new.html.twig', [
            'package' => $package,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_package_show", methods={"GET"})
     */
    public function show(Package $package): Response
    {
        return $this->render('package/show.html.twig', [
            'package' => $package,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_package_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Package $package, PackageRepository $packageRepository): Response
    {
        $form = $this->createForm(PackageType::class, $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packageRepository->add($package, true);

            return $this->redirectToRoute('app_package_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('package/edit.html.twig', [
            'package' => $package,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_package_delete", methods={"POST"})
     */
    public function delete(Request $request, Package $package, PackageRepository $packageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$package->getId(), $request->request->get('_token'))) {
            $packageRepository->remove($package, true);
        }

        return $this->redirectToRoute('app_package_index', [], Response::HTTP_SEE_OTHER);
    }
}
