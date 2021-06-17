<?php

namespace App\Controller;

use App\Entity\User; 
use App\Form\ListType;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll(); 
        return $this->render('list/index.html.twig', [
            'controller_name' => 'ListController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/list/{id}/", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id) {
        
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();
    

        return $this->redirectToRoute('list');
      }

    /**
     * @Route("/{id}/list/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {   
        $user = $this->getDoctrine()->getRepository(User::class)->find($user);
        $form = $this->createForm(ListType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('list/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

   
}
