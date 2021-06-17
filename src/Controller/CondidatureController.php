<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Condidature;
use App\Entity\Offer;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Form\CondidatureType;

class CondidatureController extends AbstractController
{
    //cette fonction permet à l'utilisateur de voir ses condidatures
    /**
     * @Route("/condidature", name="condidature", methods={"GET","POST"})
     */
    public function index(): Response
    {   
        $user= $this->getUser()->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Condidature::class);
        $condidatures = $repository->findBy(array('idUser'=> $user));

        return $this->render('condidature/mescondidatures.html.twig', ['condidatures' =>$condidatures]
            
        );
    }
    /**
     * @Route("/condidature/create/{offer}", name="condidature-create", methods={"GET","POST"})
     */
    public function new(Request $request, $offer): Response
    {
        $user = $this->getUser();
        $condidature = new Condidature();
        $form = $this->createForm(CondidatureType::class, $condidature);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
            $file = $form->get('cv')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('cv_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'condidature' property to store the PDF file name
            // instead of its contents
            $condidature->setCv($fileName);
            // end of fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
            $condidature->setEtat("not checked");
            $choffer = $entityManager->getRepository(Offer::class)->find($offer);
            $condidature->setIdOffer($choffer);
            $condidature->setIdUser($user);
            $condidature->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($condidature);
            $entityManager->flush();

            return $this->redirectToRoute('condidature');
        }

        return $this->render('condidature/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/condidature/edit/{id}", name="condidature-edit", methods={"GET","POST"})
     */
    public function edit(Request $request, $id): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $condidature = $entityManager->getRepository(Condidature::class)->find($id);
        $form = $this->createForm(CondidatureType::class, $condidature);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
            $file = $form->get('cv')->getData();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('cv_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'condidature' property to store the PDF file name
            // instead of its contents
            $condidature->setCv($fileName);
            // end of fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
            $entityManager->persist($condidature);
            $entityManager->flush();

            return $this->redirectToRoute('condidature');
        }

        return $this->render('condidature/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/condidature/delete/{id}", name="condidature-delete", methods={"GET","DELETE"}))
     */
    public function delete($id) {
            $entityManager = $this->getDoctrine()->getManager();
            $condidature = $entityManager->getRepository(Condidature::class)->find($id);
            $entityManager->remove($condidature);
            $entityManager->flush();
    
            return $this->redirectToRoute('condidature');
       

        
      }
      private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    /**
     * @Route("/condidature/reject/{id}", name="condidature-reject", methods={"GET","POST"}))
     */
    public function reject($id){
        $entityManager = $this->getDoctrine()->getManager();
        $condidature = $entityManager->getRepository(Condidature::class)->find($id);
        $condidature->setEtat("rejected");
        $entityManager->persist($condidature);
        $entityManager->flush();
        return $this->redirectToRoute('condidature');
    }
    /**
     * @Route("/condidature/accept/{id}", name="condidature-accept", methods={"GET","POST"}))
     */
    public function accept($id){
        $entityManager = $this->getDoctrine()->getManager();
        $condidature = $entityManager->getRepository(Condidature::class)->find($id);
        $condidature->setEtat("accepted");
        $entityManager->persist($condidature);
        $entityManager->flush();
        return $this->redirectToRoute('rendez-vous',['condidature'=>$condidature]);
    }

}
