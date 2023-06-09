<?php

namespace App\Controller;

use App\Form\CoteType;
use App\Entity\CoteL1Genie;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CoteL1GenieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoteL1GenieController extends AbstractController
{
    #[Route('/cote', name: 'app_cote_l1_genie', methods:['GET'])] 
    #[IsGranted('ROLE_USER')]
    public function index(CoteL1GenieRepository $respository, PaginatorInterface $paginator, Request $request): Response
    {
        $cotes = $paginator->paginate(
            $respository->findBy(['user' => $this->getUser()]), 
            $request->query->getInt('page', 1), 10 
        );
        return $this->render('cote_l1_genie/index.html.twig', [
            'cotes' => $cotes
        ]);
    }
    #[Route('/cote/edition/{id}', name:'app_cote_l1_genie.edit', methods:['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === cote.getUser()")]
    public function edit(
        CoteL1Genie $cote,
        Request $resquest,
        EntityManagerInterface $manager
        ): Response
    {
        $form = $this->createForm(CoteType::class, $cote); 

        $form->handleRequest($resquest);
        if ($form->isSubmitted() && $form->isValid()) {
            $cote = $form->getData(); 
            
            $manager->persist($cote);
            $manager->flush();

            $this->addFlash(
                'succes',
                'Le Cote a été modifié avec succès'
            );

            return $this->redirectToRoute('app_cote_l1_genie');

        }

        return $this->render('cote_l1_genie/edit.html.twig', [
        'form' => $form->createView()
    ]); 
    }
}
