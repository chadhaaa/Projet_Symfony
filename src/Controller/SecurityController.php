<?php

namespace App\Controller;

use App\Entity\User; 
use App\Form\RegistrationType; 
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name = "security_register")
     */
    public function registration(Request $request, EntityManagerInterface $entity, UserPasswordEncoderInterface $encoder)
    {
        $user = new User(); 

        $form = $this->createForm(RegistrationType::class, $user); 

        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid())
        {
            $hash = $encoder->encodePassword($user, $user->getPassword()); 

            $user->setPassword($hash); 

            $entity->persist($user); 
            $entity->flush(); 

            return $this->redirectToRoute('security_login'); 
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]); 
    }


    /**
     * @Route("/login", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig'); 
    }

    /**
     * @Route("/logout", name = "logout")
     */
    public function logout() {}
}