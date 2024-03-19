<?php

namespace App\Controller;

use App\Entity\FicheRevision;
use App\Form\FicheRevisionType;
use App\Repository\FicheRevisionRepository;
use App\Entity\Sequence;
use App\Repository\SequenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('admin/fiche_revision/')]
class AdminFicheRevisionController extends AbstractController
{
    #[Route('/{idSequence}', name: 'app_fiche_revision_index', methods: ['GET'])]
    public function index(SequenceRepository $sequenceRepository,$idSequence): Response
    {
        $sequence =$sequenceRepository->find($idSequence);
        return $this->render('admin/sequence/fiche_revision/index.html.twig', [
            'fiche_revisions' =>  $sequence->getFicheRevisions(),
            'sequence'=>$sequence
        ]);
    }

    #[Route('/{idSequence}/new', name: 'app_fiche_revision_new', methods: ['GET', 'POST'])]
    public function new(Request $request,$idSequence,SequenceRepository $sequenceRepository, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $ficheRevision = new FicheRevision();
        $ficheRevision->setSequence($sequenceRepository->find($idSequence));
        $form = $this->createForm(FicheRevisionType::class, $ficheRevision, [
            'action' => $this->generateUrl('app_fiche_revision_new',['idSequence'=>$idSequence])]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheRevisionFile = $form->get('filename')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($ficheRevisionFile) {
                $originalFilename = pathinfo($ficheRevisionFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$ficheRevisionFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $ficheRevisionFile->move(
                        $this->getParameter('fiches_revision_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $ficheRevision->setFiche($newFilename);
            }
            $entityManager->persist($ficheRevision);
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_revision_index',['idSequence'=>$idSequence], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/sequence/fiche_revision/new.html.twig', [
            'fiche_revision' => $ficheRevision,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_fiche_revision_show', methods: ['GET'])]
    public function show(FicheRevision $ficheRevision): Response
    {
        return $this->render('admin/sequence/fiche_revision/show.html.twig', [
            'fiche_revision' => $ficheRevision,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fiche_revision_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FicheRevision $ficheRevision, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FicheRevisionType::class, $ficheRevision, [
            'action' => $this->generateUrl('app_fiche_revision_edit',['id'=>$ficheRevision->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_revision_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/sequence/fiche_revision/edit.html.twig', [
            'fiche_revision' => $ficheRevision,
            'form' => $form,
        ]);
    }

    #[Route('{id}/delete', name: 'app_fiche_revision_delete', methods: ['POST'])]
    public function delete(Request $request, FicheRevision $ficheRevision, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheRevision->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ficheRevision);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fiche_revision_index', [], Response::HTTP_SEE_OTHER);
    }
}
