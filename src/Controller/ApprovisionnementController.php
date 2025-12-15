<?php


namespace App\Controller;

use App\Repository\ApprovisionnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApprovisionnementController extends AbstractController
{
    
    #[Route('/approvisionnements', name: 'app_approvisionnement')]
    public function index(ApprovisionnementRepository $approvisionnementRepository): Response
    {
        
        $approvisionnements = $approvisionnementRepository->findBy([], ['date' => 'DESC']);

        
        $totalApprovisionnements = array_sum(array_map(fn($a) => $a->getMontantTotal(), $approvisionnements));
        $nombreApprovisionnements = count($approvisionnements);

        
        return $this->render('approvisionnement/index.html.twig', [
            'approvisionnements' => $approvisionnements,
            'totalApprovisionnements' => $totalApprovisionnements,
            'nombreApprovisionnements' => $nombreApprovisionnements,
        ]);
    }
}