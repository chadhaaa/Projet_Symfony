<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findAll(); 

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories, 
        ]);
    }
    /**
     * @Route("/category/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category');
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{id}/category/edit", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {   
        $category = $this->getDoctrine()->getRepository(Category::class)->find($category);
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/{id}/", name="category_show")
     */
    public function show($id): Response
    {
        $offer = $this->getDoctrine()->getRepository(Category::class)->find($id);
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id) {
        
        $entityManager = $this->getDoctrine()->getManager();
        $category = $entityManager->getRepository(Category::class)->find($id);
        $entityManager->remove($category);
        $entityManager->flush();
    

        return $this->redirectToRoute('category');
      }
}
