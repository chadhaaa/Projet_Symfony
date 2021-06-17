<?php

namespace App\Controller;

use App\Entity\User; 
use App\Form\UserType;
use App\Form\ChangePasswordType; 

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll(); 
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/{id}/profile/edit", name="profile_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {   
        $user = $this->getDoctrine()->getRepository(User::class)->find($user);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
