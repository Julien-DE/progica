<?php

namespace App\Controller;

use App\Entity\EquipmentExt;
use App\Form\EquipmentExtType;
use App\Repository\EquipmentExtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipment/ext')]
class EquipmentExtController extends AbstractController
{
    #[Route('/', name: 'app_equipment_ext_index', methods: ['GET'])]
    public function index(EquipmentExtRepository $equipmentExtRepository): Response
    {
        return $this->render('equipment_ext/index.html.twig', [
            'equipment_exts' => $equipmentExtRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipment_ext_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipmentExtRepository $equipmentExtRepository): Response
    {
        $equipmentExt = new EquipmentExt();
        $form = $this->createForm(EquipmentExtType::class, $equipmentExt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentExtRepository->save($equipmentExt, true);

            return $this->redirectToRoute('app_equipment_ext_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipment_ext/new.html.twig', [
            'equipment_ext' => $equipmentExt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipment_ext_show', methods: ['GET'])]
    public function show(EquipmentExt $equipmentExt): Response
    {
        return $this->render('equipment_ext/show.html.twig', [
            'equipment_ext' => $equipmentExt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipment_ext_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EquipmentExt $equipmentExt, EquipmentExtRepository $equipmentExtRepository): Response
    {
        $form = $this->createForm(EquipmentExtType::class, $equipmentExt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentExtRepository->save($equipmentExt, true);

            return $this->redirectToRoute('app_equipment_ext_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipment_ext/edit.html.twig', [
            'equipment_ext' => $equipmentExt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipment_ext_delete', methods: ['POST'])]
    public function delete(Request $request, EquipmentExt $equipmentExt, EquipmentExtRepository $equipmentExtRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipmentExt->getId(), $request->request->get('_token'))) {
            $equipmentExtRepository->remove($equipmentExt, true);
        }

        return $this->redirectToRoute('app_equipment_ext_index', [], Response::HTTP_SEE_OTHER);
    }
}
