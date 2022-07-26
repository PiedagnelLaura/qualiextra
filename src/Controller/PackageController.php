<?php

namespace App\Controller;

use App\Entity\Package;
use App\Form\PackageType;
use App\Form\EditPackageType;
use App\Repository\PackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/business/packages")
 */
class PackageController extends AbstractController
{

    /**
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
     * @Route("/business/packages/{id}", name="app_pro_update_package", methods={"GET", "POST"})
     */
    public function updatePackage(Request $request, Package $package, PackageRepository $packageRepository): Response
    {
        $form = $this->createForm(EditPackageType::class, $package);
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
     * @Route("/business/packages/{id}", name="app_pro_delete_package", methods={"POST"})
     */
    public function deletePackage(Request $request, Package $package, PackageRepository $packageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$package->getId(), $request->request->get('_token'))) {
            $packageRepository->remove($package, true);
        }

        return $this->redirectToRoute('app_package_index', [], Response::HTTP_SEE_OTHER);
    }
}
