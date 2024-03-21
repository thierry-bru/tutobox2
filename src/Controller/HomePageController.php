<?php

namespace App\Controller;

use App\Repository\ExerciceRepository;
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
        $this->denyAccessUnlessGranted('ROLE_USER');
        $menu = $cursusRepository->findAll();
        
        return $this->render('home_page/index.html.twig', [
            'menu' => $menu,
        ]);
    }
    #[Route('/home/sommaire/cursus/{id}', name: 'app_cursus_sommaire', methods: ['GET'])]
    public function sommaireCursus(CursusRepository $cursusRepository,int $id): Response
{
    $nbExoDone = $cursusRepository->countExerciceOfCursusDone($this->getUser()->getId(),$id);
    $nbExo = $cursusRepository->countExerciceOfCursus($id);
    $avancement =  $nbExoDone/$nbExo*100;
    $cursus = $cursusRepository->find($id);
        return $this->render('home_page/cursus_sommaire.html.twig', [
            'cursus' => $cursus, 'menu' => $cursusRepository->findAll(),
            'avancement'=>$avancement,'done'=>$nbExoDone,'total'=>$nbExo
        ]);
    }
    #[Route('/home/sommaire/{id}', name: 'app_module_sommaire', methods: ['GET'])]
    public function sommaire(ModuleRepository $moduleRepository,CursusRepository $cursusRepository,int $id): Response
{
    $nbExoDone = $moduleRepository->countExerciceOfModuleDone($this->getUser()->getId(),$id);
    $nbExo = $moduleRepository->countExerciceOfModule($id);
    $avancement =  $nbExoDone/$nbExo*100;

        return $this->render('home_page/module_sommaire.html.twig', [
            'module' => $moduleRepository->find($id), 'menu' => $cursusRepository->findAll(),
            'avancement'=>$avancement,'done'=>$nbExoDone,'total'=>$nbExo
        ]);
    }
    #[Route('/home/sequence/{id}', name: 'app_sequence_sommaire', methods: ['GET'])]
    public function sequence(ModuleRepository $moduleRepository,SequenceRepository $SequenceRepository,CursusRepository $cursusRepository,int $id): Response
{
    $sequence = $SequenceRepository->find($id);
    $firstExercice= $sequence->getExerciceHTMLs()->first();
    $nbExoDone = $SequenceRepository->countExerciceOfSequenceDone($this->getUser()->getId(),$id);
    $nbExo = $SequenceRepository->countExerciceOfSequence($id);
    $avancement =  $nbExoDone/$nbExo*100;
        return $this->render('home_page/sequence_sommaire.html.twig', [
            'sequence' => $sequence, 'firstExercice'=>$firstExercice, 'menu' => $cursusRepository->findAll(),'avancement'=>$avancement,'done'=>$nbExoDone,'total'=>$nbExo
        ]);
    }
//     #[Route('/home/sequence/{id}/exercices/{idExercice}', name: 'app_module_exercices', methods: ['GET'])]
//     public function exercices(ModuleRepository $moduleRepository,ExerciceHTMLRepository $exerciceHTMLRepository,SequenceRepository $SequenceRepository,CursusRepository $cursusRepository,int $id, int $idExercice): Response
// {
//     $sequence = $SequenceRepository->find($id);
//     $firstExercice= $exerciceHTMLRepository->find($idExercice);
//         return $this->render('home_page/sequence_exercices.html.twig', [
//             'sequence' => $sequence, 'menu' => $cursusRepository->findAll(),'idExercice'=>$idExercice,'firstExercice'=> $firstExercice
//         ]);
//     }
    #[Route('/home/sequence/{id}/seance/{idSeance}', name: 'app_module_seance', methods: ['GET'])]
    public function seance(ModuleRepository $moduleRepository,SeanceRepository $seanceRepository,SequenceRepository $SequenceRepository,ExerciceRepository $exerciceRepository,CursusRepository $cursusRepository,int $id, int $idSeance): Response
{
    $sequence = $SequenceRepository->find($id);
    $seance= $seanceRepository->find($idSeance);
    $nombre= 0;
    $nbExoDone = $seanceRepository->countExerciceOfSeanceDone($this->getUser()->getId(),$idSeance);
    $nbExo = $seanceRepository->countExerciceOfSeance($id);
    $avancement =  $nbExoDone/$nbExo*100;
        $exercices = $seance->getExercices();
        return $this->render('home_page/seance_sommaire.html.twig', [
            'sequence' => $sequence, 'menu' => $cursusRepository->findAll(),'seance'=>$seance,'exercices'=> $exercices,'user'=>$this->getUser(),'avancement'=>$avancement,'done'=>$nbExoDone,'total'=>$nbExo
        ]);

    }
    #[Route('/show/login/', name: 'show_login_bar', methods: ['GET'])]
    public function showLoginBar(): Response
{
    $user = $this->getUser();
    return $this->render('home_page/elements/login_bar.html.twig', [
        'user' => $user
    ]);
}

#[Route('/home/seance/{idSeance}/exercices/{num}', name: 'app_seance_exercices', methods: ['GET'])]
public function exercices(ModuleRepository $moduleRepository,ExerciceRepository $exerciceRepository,SeanceRepository $seanceRepository,CursusRepository $cursusRepository, int $num=0, int $idSeance, EntityManagerInterface $entityManager): Response
{
$idExercice=0;
$seance = $seanceRepository->find($idSeance);
    $exercices= $seance->getExercices();
    for ($i=1; $i <  $num; $i++) { 
        $exercices->next();
    }
    $idExercice =  $exercices->current()->getId();
    $prec=$num-1;
    $next=$num+1;  
if ($next>$exercices->count())
    $next = 0; 
if ($prec<1)
    $prec=0;
$exercice= $exerciceRepository->find($idExercice);
    // $user = $this->getUser();
    // $user->addExercice($exercice);
    // $entityManager->flush();
    return $this->render('home_page/seance_exercices.html.twig', [
        'seance' => $seance,'sequence'=>$seance->getSequence(), 'menu' => $cursusRepository->findAll(),'idExercice'=>$idExercice,'currentExercice'=> $exercice,'prec'=>$prec,'next'=>$next
    ]);
}
}
