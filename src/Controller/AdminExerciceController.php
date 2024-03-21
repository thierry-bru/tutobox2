<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use App\Entity\ActiviteSeance;
use App\Form\ActiviteSeanceType;
use App\Repository\ActiviteSeanceRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/exercice')]
class AdminExerciceController extends AbstractController
{
    #[Route('{idSeance}/', name: 'app_admin_exercice_index', methods: ['GET'])]
    public function index(ExerciceRepository $exerciceRepository,SeanceRepository $seanceRepository,$idSeance): Response
    {
        $seance = $seanceRepository->find($idSeance);
        return $this->render('admin/exercice/index.html.twig', [
            'exercices' => $seance->getExercices(),'seance'=>$seance
        ]);
    }

    #[Route('{idSeance}/new', name: 'app_admin_exercice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SeanceRepository $seanceRepository,$idSeance, SluggerInterface $slugger): Response
    {
        $exercice = new Exercice();
        $seance = $seanceRepository->find($idSeance);
        $exercice->setSeance($seance);
        $form = $this->createForm(ExerciceType::class, $exercice, [
            'action' => $this->generateUrl('app_admin_exercice_new',['idSeance'=>$idSeance])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheSupportFile = $form->get('fichierSupport')->getData();
            $ficheCorrectionFile = $form->get('fichierCorrection')->getData();
            if ($ficheSupportFile) {
                $originalFilename = pathinfo($ficheSupportFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$ficheSupportFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $ficheSupportFile->move(
                        $this->getParameter('fiches_support_directory'), 
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $exercice->setFichierSupport($newFilename);
            }
            if ($ficheCorrectionFile) {
                $originalFilename = pathinfo($ficheCorrectionFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$ficheCorrectionFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $ficheCorrectionFile->move(
                        $this->getParameter('fiches_correction_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $exercice->setFichierCorrection($newFilename);
            }
            $entityManager->persist($exercice);
            $entityManager->flush();

            return $this->redirectToRoute('app_seance_show', ['id'=>$idSeance], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
            'seance'=>$seance
        ]);
    }

    #[Route('/{id}', name: 'app_admin_exercice_show', methods: ['GET'])]
    public function show(Exercice $exercice): Response
    {
        return $this->render('admin/exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_exercice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exercice $exercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExerciceType::class, $exercice,[
            'action' => $this->generateUrl('app_admin_exercice_edit',['id'=>$exercice->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_exercice_show', ['id'=>$exercice->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_exercice_delete', methods: ['POST'])]
    public function delete(Request $request, Exercice $exercice, EntityManagerInterface $entityManager): Response
    {
        $idSeance = $exercice->getSeance()->getId();
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seance_show', ['id'=>$idSeance], Response::HTTP_SEE_OTHER);
    }
}
