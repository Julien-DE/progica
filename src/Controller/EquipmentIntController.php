<?php

namespace App\Controller;

use App\Entity\EquipmentInt;
use App\Form\EquipmentIntType;
use App\Repository\EquipmentIntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipment/int')]
class EquipmentIntController extends AbstractController
{
    #[Route('/', name: 'app_equipment_int_index', methods: ['GET'])]
    public function index(EquipmentIntRepository $equipmentIntRepository): Response
    {
        return $this->render('equipment_int/index.html.twig', [
            'equipment_ints' => $equipmentIntRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipment_int_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipmentIntRepository $equipmentIntRepository): Response
    {
        $equipmentInt = new EquipmentInt();
        $form = $this->createForm(EquipmentIntType::class, $equipmentInt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentIntRepository->save($equipmentInt, true);

            return $this->redirectToRoute('app_equipment_int_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipment_int/new.html.twig', [
            'equipment_int' => $equipmentInt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipment_int_show', methods: ['GET'])]
    public function show(EquipmentInt $equipmentInt): Response
    {
        return $this->render('equipment_int/show.html.twig', [
            'equipment_int' => $equipmentInt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipment_int_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EquipmentInt $equipmentInt, EquipmentIntRepository $equipmentIntRepository): Response
    {
        $form = $this->createForm(EquipmentIntType::class, $equipmentInt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentIntRepository->save($equipmentInt, true);

            return $this->redirectToRoute('app_equipment_int_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipment_int/edit.html.twig', [
            'equipment_int' => $equipmentInt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipment_int_delete', methods: ['POST'])]
    public function delete(Request $request, EquipmentInt $equipmentInt, EquipmentIntRepository $equipmentIntRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipmentInt->getId(), $request->request->get('_token'))) {
            $equipmentIntRepository->remove($equipmentInt, true);
        }

        return $this->redirectToRoute('app_equipment_int_index', [], Response::HTTP_SEE_OTHER);
    }
}
