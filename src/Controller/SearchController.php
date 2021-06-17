<?php

namespace App\Controller;

use App\Entity\User; 
use App\Form\SearchType; 
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function searchCandidat(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $search = $this->createForm(SearchType::class); 
        $jobs = $entityManager->getRepository(User::class)->findAll(); 
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'jobs' => $jobs, 
            'search' => $search->createView()
            
        ]);
    }
}
