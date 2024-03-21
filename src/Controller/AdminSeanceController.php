<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceType;
use App\Repository\SeanceRepository;
use App\Repository\SequenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CursusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/seance')]
class AdminSeanceController extends AbstractController
{
    #[Route('/{idSequence}', name: 'app_seance_index', methods: ['GET'])]
    public function index(SeanceRepository $seanceRepository,CursusRepository $cursusRepository, $idSequence, SequenceRepository $sequenceRepository): Response
    {
        $sequence = $sequenceRepository->find($idSequence);
        return $this->render('admin/sequence/seance/index.html.twig', [
            'seances' => $sequence->getSeances(),'sequence'=>$sequence,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{idSequence}/new', name: 'app_seance_new', methods: ['GET', 'POST'])]
    public function new(Request $request,$idSequence, EntityManagerInterface $entityManager,CursusRepository $cursusRepository, SequenceRepository $sequenceRepository): Response
    {
        $seance = new Seance();
        $seance->setSequence($sequenceRepository->find($idSequence));
        $form = $this->createForm(SeanceType::class, $seance, [
            'action' => $this->generateUrl('app_seance_new',['idSequence'=>$idSequence])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seance);
            $entityManager->flush();
            return $this->redirectToRoute('app_sequence_show',['id'=>$idSequence], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/sequence/seance/new.html.twig', [
            'seance' => $seance,
            'form' => $form,'menu' => $cursusRepository->findAll(),
            'idSequence'=>$idSequence
        ]);
    }

    #[Route('/{id}/show', name: 'app_seance_show', methods: ['GET'])]
    public function show(Seance $seance,CursusRepository $cursusRepository): Response
    {
        return $this->render('admin/sequence/seance/show.html.twig', [
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

            return $this->redirectToRoute('app_seance_show', ['id'=>$seance->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/sequence/seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form,'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_seance_delete', methods: ['POST'])]
    public function delete(Request $request, Seance $seance, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sequence_show',['id'=>$seance->getSequence()->getId()], Response::HTTP_SEE_OTHER);
    }
}
