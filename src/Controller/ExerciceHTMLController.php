<?php

namespace App\Controller;

use App\Entity\ExerciceHTML;
use App\Form\ExerciceHTMLType;
use App\Repository\CursusRepository;
use App\Repository\ExerciceHTMLRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/admin/exercicehtml')]
class ExerciceHTMLController extends AbstractController
{
    #[Route('/', name: 'app_exercice_h_t_m_l_index', methods: ['GET'])]
    public function index(ExerciceHTMLRepository $exerciceHTMLRepository,CursusRepository $cursusRepository): Response
    {
        return $this->render('exercice_html/index.html.twig', [
            'exercice_h_t_m_ls' => $exerciceHTMLRepository->findAll(), 'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_exercice_h_t_m_l_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,CursusRepository $cursusRepository, SluggerInterface $slugger): Response
    {
        $exerciceHTML = new ExerciceHTML();
        $form = $this->createForm(ExerciceHTMLType::class, $exerciceHTML);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciceFile = $form->get('filename')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($exerciceFile) {
                $originalFilename = pathinfo($exerciceFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$exerciceFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $exerciceFile->move(
                        $this->getParameter('exercicehtml_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $exerciceHTML->setFileName($newFilename);
            }
            $entityManager->persist($exerciceHTML);
            $entityManager->flush();

            return $this->redirectToRoute('app_exercice_h_t_m_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice_html/new.html.twig', [
            'exercice_h_t_m_l' => $exerciceHTML,
            'form' => $form, 'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_exercice_h_t_m_l_show', methods: ['GET'])]
    public function show(ExerciceHTML $exerciceHTML,CursusRepository $cursusRepository): Response
    {
        return $this->render('exercice_html/show.html.twig', [
            'exercice_h_t_m_l' => $exerciceHTML, 'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_exercice_h_t_m_l_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExerciceHTML $exerciceHTML, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $form = $this->createForm(ExerciceHTMLType::class, $exerciceHTML);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_exercice_h_t_m_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice_html/edit.html.twig', [
            'exercice_h_t_m_l' => $exerciceHTML,
            'form' => $form, 'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_exercice_h_t_m_l_delete', methods: ['POST'])]
    public function delete(Request $request, ExerciceHTML $exerciceHTML, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exerciceHTML->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exerciceHTML);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_exercice_h_t_m_l_index', [], Response::HTTP_SEE_OTHER);
    }
}
