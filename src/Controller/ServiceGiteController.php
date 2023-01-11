<?php

namespace App\Controller;

use App\Entity\ServiceGite;
use App\Form\ServiceGiteType;
use App\Repository\ServiceGiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/service/gite')]
class ServiceGiteController extends AbstractController
{
    #[Route('/', name: 'app_service_gite_index', methods: ['GET'])]
    public function index(ServiceGiteRepository $serviceGiteRepository): Response
    {
        return $this->render('service_gite/index.html.twig', [
            'service_gites' => $serviceGiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_service_gite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ServiceGiteRepository $serviceGiteRepository): Response
    {
        $serviceGite = new ServiceGite();
        $form = $this->createForm(ServiceGiteType::class, $serviceGite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceGiteRepository->save($serviceGite, true);

            return $this->redirectToRoute('app_service_gite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service_gite/new.html.twig', [
            'service_gite' => $serviceGite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_service_gite_show', methods: ['GET'])]
    public function show(ServiceGite $serviceGite): Response
    {
        return $this->render('service_gite/show.html.twig', [
            'service_gite' => $serviceGite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_service_gite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ServiceGite $serviceGite, ServiceGiteRepository $serviceGiteRepository): Response
    {
        $form = $this->createForm(ServiceGiteType::class, $serviceGite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceGiteRepository->save($serviceGite, true);

            return $this->redirectToRoute('app_service_gite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service_gite/edit.html.twig', [
            'service_gite' => $serviceGite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_service_gite_delete', methods: ['POST'])]
    public function delete(Request $request, ServiceGite $serviceGite, ServiceGiteRepository $serviceGiteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serviceGite->getId(), $request->request->get('_token'))) {
            $serviceGiteRepository->remove($serviceGite, true);
        }

        return $this->redirectToRoute('app_service_gite_index', [], Response::HTTP_SEE_OTHER);
    }
}
