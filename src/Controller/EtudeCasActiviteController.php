<?php

namespace App\Controller;

use App\Entity\EtudeCasActivite;
use App\Form\EtudeCasActiviteType;
use App\Repository\EtudeCasActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etude/cas/activite')]
class EtudeCasActiviteController extends AbstractController
{
    #[Route('/', name: 'app_etude_cas_activite_index', methods: ['GET'])]
    public function index(EtudeCasActiviteRepository $etudeCasActiviteRepository): Response
    {
        return $this->render('etude_cas_activite/index.html.twig', [
            'etude_cas_activites' => $etudeCasActiviteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etude_cas_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etudeCasActivite = new EtudeCasActivite();
        $form = $this->createForm(EtudeCasActiviteType::class, $etudeCasActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etudeCasActivite);
            $entityManager->flush();

            return $this->redirectToRoute('app_etude_cas_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etude_cas_activite/new.html.twig', [
            'etude_cas_activite' => $etudeCasActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etude_cas_activite_show', methods: ['GET'])]
    public function show(EtudeCasActivite $etudeCasActivite): Response
    {
        return $this->render('etude_cas_activite/show.html.twig', [
            'etude_cas_activite' => $etudeCasActivite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etude_cas_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EtudeCasActivite $etudeCasActivite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtudeCasActiviteType::class, $etudeCasActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etude_cas_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etude_cas_activite/edit.html.twig', [
            'etude_cas_activite' => $etudeCasActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etude_cas_activite_delete', methods: ['POST'])]
    public function delete(Request $request, EtudeCasActivite $etudeCasActivite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudeCasActivite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etudeCasActivite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etude_cas_activite_index', [], Response::HTTP_SEE_OTHER);
    }
}
