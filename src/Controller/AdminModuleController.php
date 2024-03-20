<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use App\Repository\CursusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/module')]
class AdminModuleController extends AbstractController
{
    #[Route('/{idCursus}/list', name: 'app_module_index', methods: ['GET'])]
    public function list(ModuleRepository $moduleRepository,CursusRepository $cursusRepository,$idCursus): Response
{
    $cursus = $cursusRepository->find($idCursus);
        return $this->render('admin/module/index.html.twig', [
            'modules' => $cursus->getModules(), 'menu' => $cursusRepository->findAll(),'cursus'=>$cursus
        ]);
    }

    #[Route('/{idCursus}/new', name: 'app_module_new', methods: ['GET', 'POST'])]
    public function newModule(Request $request,$idCursus,EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $module = new Module();
        $module->setCursus($cursusRepository->find($idCursus));
        $form = $this->createForm(ModuleType::class, $module, [
            'action' => $this->generateUrl('app_module_new',['idCursus'=>$idCursus])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($module);
            $entityManager->flush();

            return $this->redirectToRoute('app_module_index', ['idCursus'=>$module->getCursus()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/module/new.html.twig', [
            'module' => $module,
            'form' => $form, 'menu' => $cursusRepository->findAll(),
            'idCursus'=>$idCursus
        ]);
    }

    #[Route('/{id}', name: 'app_module_show', methods: ['GET'])]
    public function showModule(Module $module,CursusRepository $cursusRepository): Response
    {
        return $this->render('admin/module/show.html.twig', [
            'module' => $module, 'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_module_edit', methods: ['GET', 'POST'])]
    public function editModule(Request $request, Module $module, EntityManagerInterface $entityManager,CursusRepository $cursusRepository): Response
    {
        $form = $this->createForm(ModuleType::class, $module, [
            'action' => $this->generateUrl('app_module_edit',['id'=>$module->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cursus_show', ['id'=>$module->getCursus()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/module/edit.html.twig', [
            'module' => $module,
            'form' => $form, 'menu' => $cursusRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_module_delete', methods: ['POST'])]
    public function deleteModule(Request $request, Module $module, EntityManagerInterface $entityManager): Response
    {
        $idCursus = $module->getCursus()->getId();
        if ($this->isCsrfTokenValid('delete'.$module->getId(), $request->request->get('_token'))) {
            $entityManager->remove($module);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cursus_show', ['id'=>$idCursus], Response::HTTP_SEE_OTHER);
    }
}
