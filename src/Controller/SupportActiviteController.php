<?php

namespace App\Controller;

use App\Entity\SupportActivite;
use App\Form\SupportActiviteType;
use App\Repository\SupportActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/support/activite')]
class SupportActiviteController extends AbstractController
{
    #[Route('/', name: 'app_support_activite_index', methods: ['GET'])]
    public function index(SupportActiviteRepository $supportActiviteRepository): Response
    {
        return $this->render('support_activite/index.html.twig', [
            'support_activites' => $supportActiviteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_support_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $supportActivite = new SupportActivite();
        $form = $this->createForm(SupportActiviteType::class, $supportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($supportActivite);
            $entityManager->flush();

            return $this->redirectToRoute('app_support_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('support_activite/new.html.twig', [
            'support_activite' => $supportActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_support_activite_show', methods: ['GET'])]
    public function show(SupportActivite $supportActivite): Response
    {
        return $this->render('support_activite/show.html.twig', [
            'support_activite' => $supportActivite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_support_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SupportActivite $supportActivite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SupportActiviteType::class, $supportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_support_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('support_activite/edit.html.twig', [
            'support_activite' => $supportActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_support_activite_delete', methods: ['POST'])]
    public function delete(Request $request, SupportActivite $supportActivite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supportActivite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($supportActivite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_support_activite_index', [], Response::HTTP_SEE_OTHER);
    }
}
