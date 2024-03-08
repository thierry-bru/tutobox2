<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Cursus;
use App\Form\CursusType;
use App\Repository\ActiviteSeanceRepository;
use App\Repository\CursusRepository;
use App\Repository\ExerciceHTMLRepository;
use App\Repository\ModuleRepository;
use App\Repository\SeanceRepository;
use App\Repository\SequenceRepository;
use Doctrine\ORM\EntityManagerInterface;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(CursusRepository $cursusRepository): Response
    {
        $menu = $cursusRepository->findAll();
        
        return $this->render('home_page/index.html.twig', [
            'menu' => $menu,
        ]);
    }
    #[Route('/home/sommaire/{id}', name: 'app_module_sommaire', methods: ['GET'])]
    public function sommaire(ModuleRepository $moduleRepository,CursusRepository $cursusRepository,int $id): Response
{
        return $this->render('home_page/module_sommaire.html.twig', [
            'module' => $moduleRepository->find($id), 'menu' => $cursusRepository->findAll(),
        ]);
    }
    #[Route('/home/sequence/{id}', name: 'app_sequence_sommaire', methods: ['GET'])]
    public function sequence(ModuleRepository $moduleRepository,SequenceRepository $SequenceRepository,CursusRepository $cursusRepository,int $id): Response
{
    $sequence = $SequenceRepository->find($id);
    $firstExercice= $sequence->getExerciceHTMLs()->first();

        return $this->render('home_page/sequence_sommaire.html.twig', [
            'sequence' => $sequence, 'firstExercice'=>$firstExercice, 'menu' => $cursusRepository->findAll(),
        ]);
    }
    #[Route('/home/sequence/{id}/exercices/{idExercice}', name: 'app_module_exercices', methods: ['GET'])]
    public function exercices(ModuleRepository $moduleRepository,ExerciceHTMLRepository $exerciceHTMLRepository,SequenceRepository $SequenceRepository,CursusRepository $cursusRepository,int $id, int $idExercice): Response
{
    $sequence = $SequenceRepository->find($id);
    $firstExercice= $exerciceHTMLRepository->find($idExercice);
        return $this->render('home_page/sequence_exercices.html.twig', [
            'sequence' => $sequence, 'menu' => $cursusRepository->findAll(),'idExercice'=>$idExercice,'firstExercice'=> $firstExercice
        ]);
    }
    #[Route('/home/sequence/{id}/seance/{idSeance}/{num}', name: 'app_module_seance', methods: ['GET'])]
    public function seance(ModuleRepository $moduleRepository,SeanceRepository $seanceRepository,SequenceRepository $SequenceRepository,ActiviteSeanceRepository $activiteSeanceRepository,CursusRepository $cursusRepository,int $id, int $idSeance, int $num =0): Response
{
    $sequence = $SequenceRepository->find($id);
    $seance= $seanceRepository->find($idSeance);
    if (!isset($num)||$num==0)
    {
        $num=0;
        $activite = $seance->getActivites()->first();
    }
    else
        $activite = $activiteSeanceRepository->find($num);
       
        return $this->render('home_page/seance_sommaire.html.twig', [
            'sequence' => $sequence, 'menu' => $cursusRepository->findAll(),'seance'=>$seance,'num'=>$num,'activiteActive'=> $activite
        ]);
    }
}
