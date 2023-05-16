<?php

namespace App\Controller;

use App\Entity\EtudiantL1Genie;
use App\Form\EtudiantType;
use App\Repository\EtudiantL1GenieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantL1GenieController extends AbstractController
{
    /**
     * This function display all Etudiants
     *
     * @param EtudiantL1GenieRepository $respository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/etudiant', name: 'app_etudiant_l1_genie', methods:['GET'])]
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

    #[Route ('/etudiant/nouveau', name:'app_etudiant_l1_genie.new', methods:['GET', 'POST'])]
    public function new(
        Request $resquest,
        EntityManagerInterface $manager
        ): Response
    {
        $etudiant = new EtudiantL1Genie(); 
        $form = $this->createForm(EtudiantType::class, $etudiant); 

        $form->handleRequest($resquest);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData(); 
            
            $manager->persist($etudiant);
            $manager->flush();

            $this->addFlash(
                'succes',
                'L\'Etudiant a été créé avec succès'
            );

            return $this->redirectToRoute('app_etudiant_l1_genie');

        }

        return $this->render('etudiant_l1_genie/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
