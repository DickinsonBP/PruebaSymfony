<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use App\Form\Type\ProviderFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;


class MainController extends AbstractController
{

    /**
     * @Route("/", name="app_index")
     *
     * @param ProviderRepository $providerRepository
     *
     * @return Response
     */
    public function index(ProviderRepository $providerRepository)
    {
        return $this->render(
          'provider/list.html.twig', 
          [
            'title' => 'Proveedores',
            'btn_create' => 'Nuevo proveedor',
            'providers' => $providerRepository->findAll()
          ]
      );
    }

    /**
     * @Route("/create", name="app_create_provider")
     * 
     * @param Request $request
     *
     * @return Response
     */
    public function createProvider(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ProviderFormType::class, new Provider());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $provider = $form->getData();
            $entityManager->persist($provider);
            $entityManager->flush();
            $this->addFlash('success', 'Nuevo proveedor creado!');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('provider/create.html.twig', [
          'title' => 'Nuevo proveedor',
          'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="app_editprovider")
     *
     * @ParamConverter("provider", class="App\Entity\Provider")
     *
     * @return Response
     */
    public function editProvider(Provider $provider, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ProviderFormType::class, $provider);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $provider = $form->getData();

            $entityManager->persist($provider);
            $entityManager->flush();
            $this->addFlash('success', 'Se ha editado el proveedor!');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('provider/create.html.twig', [
            'title'=> 'Editar proveedor',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_providerdelete")
     *
     * @param Provider $provider
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse
     */
    public function deleteProvider(Provider $provider, EntityManagerInterface $em): RedirectResponse
    {
        $em->remove($provider);
        $em->flush();
        $this->addFlash('success', 'Proveedor eliminado!');

        return $this->redirectToRoute('app_index');
    }
}