<?php

namespace App\Controller;

use App\Entity\TypeExercice;
use App\Form\TypeExerciceType;
use App\Repository\TypeExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/exercice')]
class TypeExerciceController extends AbstractController
{
    #[Route('/', name: 'app_type_exercice_index', methods: ['GET'])]
    public function index(TypeExerciceRepository $typeExerciceRepository): Response
    {
        return $this->render('type_exercice/index.html.twig', [
            'type_exercices' => $typeExerciceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_exercice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeExercice = new TypeExercice();
        $form = $this->createForm(TypeExerciceType::class, $typeExercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeExercice);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_exercice/new.html.twig', [
            'type_exercice' => $typeExercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_exercice_show', methods: ['GET'])]
    public function show(TypeExercice $typeExercice): Response
    {
        return $this->render('type_exercice/show.html.twig', [
            'type_exercice' => $typeExercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_exercice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeExercice $typeExercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeExerciceType::class, $typeExercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_exercice/edit.html.twig', [
            'type_exercice' => $typeExercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_exercice_delete', methods: ['POST'])]
    public function delete(Request $request, TypeExercice $typeExercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeExercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeExercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_exercice_index', [], Response::HTTP_SEE_OTHER);
    }
}
