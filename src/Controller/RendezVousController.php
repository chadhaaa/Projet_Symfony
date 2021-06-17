<?php

namespace App\Controller;

use App\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RendezVousType;
class RendezVousController extends AbstractController
{
    /**
     * @Route("/rendezvous/{condidature}", name="rendez-vous")
     */
    public function create($condidature){
        $form = $this->createForm(RendezVousType::class, $condidature);
        if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $rendezvous = new RendezVous ();
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
