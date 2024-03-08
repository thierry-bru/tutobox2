<?php

namespace App\Controller;

use App\Entity\ActiviteSeance;
use App\Form\ActiviteSeanceType;
use App\Repository\ActiviteSeanceRepository;
use App\Repository\CursusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/activite')]
class ActiviteSeanceController extends AbstractController
{
    #[Route('/', name: 'app_activite_seance_index', methods: ['GET'])]
    public function index(ActiviteSeanceRepository $activiteSeanceRepository,CursusRepository $cursusRepository): Response
    {
        return $this->render('activite_seance/index.html.twig', [
            'activite_seances' => $activiteSeanceRepository->findAll(),'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activite_seance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $activiteSeance = new ActiviteSeance();
        $form = $this->createForm(ActiviteSeanceType::class, $activiteSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($activiteSeance);
            $entityManager->flush();

            return $this->redirectToRoute('app_activite_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('activite_seance/new.html.twig', [
            'activite_seance' => $activiteSeance,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_activite_seance_show', methods: ['GET'])]
    public function show(ActiviteSeance $activiteSeance,CursusRepository $cursusRepository): Response
    {
        return $this->render('activite_seance/show.html.twig', [
            'activite_seance' => $activiteSeance,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activite_seance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ActiviteSeance $activiteSeance, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $form = $this->createForm(ActiviteSeanceType::class, $activiteSeance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_activite_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('activite_seance/edit.html.twig', [
            'activite_seance' => $activiteSeance,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_activite_seance_delete', methods: ['POST'])]
    public function delete(Request $request, ActiviteSeance $activiteSeance, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activiteSeance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($activiteSeance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activite_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
