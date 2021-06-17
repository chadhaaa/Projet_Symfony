<?php

namespace App\Controller;

use App\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RendezVousType;
use App\Entity\Condidature;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class RendezVousController extends AbstractController
{
    /**
     * @Route("/rendezvous/{condidature}", name="rendez-vous")
     * @IsGranted("ROLE_RECRUTEUR")
     */
    public function create($condidature){
        $rendezvous = new RendezVous ();
        $form = $this->createForm(RendezVousType::class, $rendezvous);
        if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $rendezvous->getCreatedAt(new \DateTime('now'));
        $rendezvous->setCondidature($condidature);
        $entityManager->persist($rendezvous);
        $entityManager->flush();
        }
        return $this->render('rendez_vous/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
