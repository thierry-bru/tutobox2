<?php

namespace App\Controller;

use App\Entity\Sequence;
use App\Form\SequenceType;
use App\Repository\SequenceRepository;
use App\Repository\CursusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/sequence')]
class SequenceController extends AbstractController
{
    #[Route('/', name: 'app_sequence_index', methods: ['GET'])]
    public function index(SequenceRepository $sequenceRepository,CursusRepository $cursusRepository): Response
    {
        return $this->render('sequence/index.html.twig', [
            'sequences' => $sequenceRepository->findAll(),'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sequence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $sequence = new Sequence();
        $form = $this->createForm(SequenceType::class, $sequence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sequence);
            $entityManager->flush();

            return $this->redirectToRoute('app_sequence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sequence/new.html.twig', [
            'sequence' => $sequence,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_sequence_show', methods: ['GET'])]
    public function show(Sequence $sequence,CursusRepository $cursusRepository): Response
    {
        return $this->render('sequence/show.html.twig', [
            'sequence' => $sequence,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sequence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sequence $sequence, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $form = $this->createForm(SequenceType::class, $sequence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sequence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sequence/edit.html.twig', [
            'sequence' => $sequence,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_sequence_delete', methods: ['POST'])]
    public function delete(Request $request, Sequence $sequence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sequence->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sequence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sequence_index', [], Response::HTTP_SEE_OTHER);
    }
}
