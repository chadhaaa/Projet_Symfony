<?php

namespace App\Controller;

use App\Entity\Offer; 
use App\Form\OfferType;

use App\Entity\Category;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OfferController extends AbstractController
{
    /**
     * @Route("/offer", name="offer", methods={"GET"})
     */
    public function index(OfferRepository $offerRepository, EntityManagerInterface $entityManager): Response
    {
        $offers = $entityManager->getRepository(Offer::class)->findAll(); 

        return $this->render('offer/index.html.twig', [
            'controller_name' => 'OfferController',
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/new", name="offer_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category(); 
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            //$entityManager->persist($category); 
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('offer');
        }

        return $this->render('offer/new.html.twig', [
            'category' => $category,
            'offer' => $offer,
            'form' => $form->createView(), 
        ]);
    }

     /**
     * @Route("/{id}/edit", name="offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offer $offer): Response
    {   
        $offer = $this->getDoctrine()->getRepository(Offer::class)->find($offer);
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offer');
        }

        return $this->render('offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/offer/{id}/", name="offer_show")
     */
    public function show($id): Response
    {
        $offer = $this->getDoctrine()->getRepository(Offer::class)->find($id);
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/{id}/", name="offer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id) {
        
        $entityManager = $this->getDoctrine()->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);
        $entityManager->remove($offer);
        $entityManager->flush();
    

        return $this->redirectToRoute('offer');
      }
}
