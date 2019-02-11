<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Loisirs;
use App\Form\LoisirsType;

class LoisirsController extends Controller
{
    public function create()
    {
        $loisir = new Loisirs();
        $form = $this->createForm(LoisirsType::class, $loisir);
        
        return $this->render('loisirs/create.html.twig', [
            'entity' => $loisir,
            'form' => $form->createView(),
            ]
            );
    }
 public function valid(Request $request)
 {
     $loisir = new Loisirs();
     $form = $this->createForm(LoisirsType::class, $loisir);
     
     $form->handleRequest($request);
     if ($form->isSubmitted() && $form->isValid()) {
         $loisirs = $form->getData();
         
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($loisir);
         $entityManager->flush();
         
         return $this->redirectToRoute('app_lucky_number');
         
     }
     
     return $this->render('loisirs/create.html.twig', [
         'entity' => $loisir,
         'form' => $form->createView(),
         ]
         );
 }
}
