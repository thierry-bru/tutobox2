<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Form\CursusType;
use App\Repository\CursusRepository;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\UX\Turbo\TurboBundle;

#[Route('/admin/cursus')]
class AdminCursusController extends AbstractController
{
    #[Route('/', name: 'app_cursus_index', methods: ['GET'])]
    public function index(CursusRepository $cursusRepository): Response
    {
        return $this->render('admin/cursus/index.html.twig', [
            'cursuses' => $cursusRepository->findAll(),'menu' => $cursusRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_cursus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $cursu = new Cursus();
        $form = $this->createForm(CursusType::class, $cursu, [
            'action' => $this->generateUrl('app_cursus_new')]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $illustrationFile = $form->get('image')->getData();
            if ($illustrationFile) {
                $originalFilename = pathinfo($illustrationFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$illustrationFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $illustrationFile->move(
                        $this->getParameter('illustrations_directory'), 
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $cursu->setImage($newFilename);
            }
            $entityManager->persist($cursu);
            $entityManager->flush();
            if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
                // If the request comes from Turbo, set the content type as text/vnd.turbo-stream.html and only send the HTML to update
                $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
            return $this->redirectToRoute('app_cursus_index', [], Response::HTTP_SEE_OTHER);
            }
            return $this->redirectToRoute('app_cursus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/cursus/new.html.twig', [
            'cursu' => $cursu,
            'form' => $form,'menu' => $cursu,
        ]);
    }

    #[Route('/{id}', name: 'app_cursus_show', methods: ['GET'])]
    public function show(Cursus $cursu): Response
    {
        return $this->render('admin/cursus/show.html.twig', [
            'cursu' => $cursu,'menu' => $cursu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cursus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cursus $cursu, EntityManagerInterface $entityManager,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CursusType::class, $cursu, [
            'action' => $this->generateUrl('app_cursus_edit',['id'=>$cursu->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $illustrationFile = $form->get('image')->getData();
            if ($illustrationFile) {
                $originalFilename = pathinfo($illustrationFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$illustrationFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $illustrationFile->move(
                        $this->getParameter('illustrations_directory'), 
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $cursu->setImage($newFilename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_cursus_show', ['id'=>$cursu->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/cursus/edit.html.twig', [
            'cursu' => $cursu,
            'form' => $form,'menu' => $cursu,
        ]);
    }

    #[Route('/{id}', name: 'app_cursus_delete', methods: ['POST'])]
    public function delete(Request $request, Cursus $cursu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cursu->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cursu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cursus_index', [], Response::HTTP_SEE_OTHER);
    }
   
}
