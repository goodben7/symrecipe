<?php

namespace App\Controller;

use App\Form\EtudiantType;
use App\Entity\CoteL1Genie;
use App\Entity\EtudiantL1Genie;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\EtudiantL1GenieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantL1GenieController extends AbstractController
{
    /**
     * This controller display all Etudiants
     *
     * @param EtudiantL1GenieRepository $respository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response 
     */
    #[Route('/etudiant', name: 'app_etudiant_l1_genie', methods:['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(EtudiantL1GenieRepository $respository, PaginatorInterface $paginator, Request $request): Response
    {
        $etudiants = $paginator->paginate(
            $respository->findBy(['user' => $this->getUser()]),
            $request->query->getInt('page', 1), 10 
        );
        return $this->render('etudiant_l1_genie/index.html.twig', [
            'etudiants' => $etudiants
        ]);
    }


    /**
     * This controller show a form which create an Etudiants
     *
     * @param Request $resquest
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route ('/etudiant/nouveau', name:'app_etudiant_l1_genie.new', methods:['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
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
            $etudiant->setUser($this->getUser());
            
            $manager->persist($etudiant);

            $cote = new CoteL1Genie(); 
            $cote->setUser($this->getUser());
            $cote->setEtudiant($etudiant);

            $manager->persist($cote);

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

    #[Route('/etudiant/edition/{id}', name:'app_etudiant_l1_genie.edit', methods:['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === etudiant.getUser()")]
    public function edit(
        EtudiantL1Genie $etudiant,
        Request $resquest,
        EntityManagerInterface $manager
        ): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant); 

        $form->handleRequest($resquest);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData(); 
            
            $manager->persist($etudiant);
            $manager->flush();

            $this->addFlash(
                'succes',
                'L\'Etudiant a été modifié avec succès'
            );

            return $this->redirectToRoute('app_etudiant_l1_genie');

        }

        return $this->render('etudiant_l1_genie/edit.html.twig', [
        'form' => $form->createView()
    ]); 
    }

    #[Route('/etudiant/supression/{id}', name: 'app_etudiant_l1_genie.delete', methods: ['GET'])]
    #[Security("is_granted('ROLE_USER') and user === etudiant.getUser()")]
    public function delete(EntityManagerInterface $manager, EtudiantL1Genie $etudiant): Response 
    {

        $manager->remove($etudiant); 
        $manager->flush();

        $this->addFlash(
            'succes',
            'L\'Etudiant a été supprimé avec succès'
        );

        return $this->redirectToRoute('app_etudiant_l1_genie');
    }
}
