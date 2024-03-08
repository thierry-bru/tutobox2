<?php

namespace App\Controller;

use App\Entity\ModaliteActivite;
use App\Form\ModaliteActiviteType;
use App\Repository\CursusRepository;
use App\Repository\ModaliteActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/modalite')]
class ModaliteActiviteController extends AbstractController
{
    #[Route('/', name: 'app_modalite_activite_index', methods: ['GET'])]
    public function index(ModaliteActiviteRepository $modaliteActiviteRepository,CursusRepository $cursusRepository): Response
    {
        return $this->render('modalite_activite/index.html.twig', [
            'modalite_activites' => $modaliteActiviteRepository->findAll(),'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_modalite_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $modaliteActivite = new ModaliteActivite();
        $form = $this->createForm(ModaliteActiviteType::class, $modaliteActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($modaliteActivite);
            $entityManager->flush();

            return $this->redirectToRoute('app_modalite_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modalite_activite/new.html.twig', [
            'modalite_activite' => $modaliteActivite,'menu' => $cursusRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modalite_activite_show', methods: ['GET'])]
    public function show(ModaliteActivite $modaliteActivite,CursusRepository $cursusRepository): Response
    {
        return $this->render('modalite_activite/show.html.twig', [
            'modalite_activite' => $modaliteActivite,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_modalite_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModaliteActivite $modaliteActivite, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $form = $this->createForm(ModaliteActiviteType::class, $modaliteActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_modalite_activite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modalite_activite/edit.html.twig', [
            'modalite_activite' => $modaliteActivite,'menu' => $cursusRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modalite_activite_delete', methods: ['POST'])]
    public function delete(Request $request, ModaliteActivite $modaliteActivite, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modaliteActivite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($modaliteActivite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_modalite_activite_index', [], Response::HTTP_SEE_OTHER);
    }
}
