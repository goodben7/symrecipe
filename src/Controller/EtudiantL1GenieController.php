<?php

namespace App\Controller;

use App\Repository\EtudiantL1GenieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantL1GenieController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant_l1_genie')]
    public function index(EtudiantL1GenieRepository $respository, PaginatorInterface $paginator, Request $request): Response
    {
        $etudiants = $paginator->paginate(
            $respository->findAll(),
            $request->query->getInt('page', 1), 10 
        );
        return $this->render('etudiant_l1_genie/index.html.twig', [
            'etudiants' => $etudiants
        ]);
    }
}
