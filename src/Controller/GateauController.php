<?php

namespace App\Controller;

use App\Entity\Gateau;
use App\Form\GateauType;
use App\Repository\GateauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gateau")
 */
class GateauController extends Controller
{
    /**
     * @Route("/", name="gateau_index", methods={"GET"})
     */
    public function index(GateauRepository $gateauRepository): Response
    {
        return $this->render('gateau/index.html.twig', [
            'gateaus' => $gateauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gateau_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gateau = new Gateau();
        $form = $this->createForm(GateauType::class, $gateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gateau);
            $entityManager->flush();

            return $this->redirectToRoute('gateau_index');
        }

        return $this->render('gateau/new.html.twig', [
            'gateau' => $gateau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gateau_show", methods={"GET"})
     */
    public function show(Gateau $gateau): Response
    {
        return $this->render('gateau/show.html.twig', [
            'gateau' => $gateau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gateau_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gateau $gateau): Response
    {
        $form = $this->createForm(GateauType::class, $gateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gateau_index', [
                'id' => $gateau->getId(),
            ]);
        }

        return $this->render('gateau/edit.html.twig', [
            'gateau' => $gateau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gateau_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Gateau $gateau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gateau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gateau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gateau_index');
    }
}
