<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceType;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CursusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/seance')]
class AdminSeanceController extends AbstractController
{
    #[Route('/', name: 'app_seance_index', methods: ['GET'])]
    public function index(SeanceRepository $seanceRepository,CursusRepository $cursusRepository): Response
    {
        return $this->render('admin/seance/index.html.twig', [
            'seances' => $seanceRepository->findAll(),'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_seance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $seance = new Seance();
        $form = $this->createForm(SeanceType::class, $seance, [
            'action' => $this->generateUrl('app_seance_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seance);
            $entityManager->flush();

            return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/seance/new.html.twig', [
            'seance' => $seance,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_seance_show', methods: ['GET'])]
    public function show(Seance $seance,CursusRepository $cursusRepository): Response
    {
        return $this->render('admin/seance/show.html.twig', [
            'seance' => $seance,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_seance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seance $seance, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $form = $this->createForm(SeanceType::class, $seance, [
            'action' => $this->generateUrl('app_seance_edit',['id'=>$seance->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_seance_delete', methods: ['POST'])]
    public function delete(Request $request, Seance $seance, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
