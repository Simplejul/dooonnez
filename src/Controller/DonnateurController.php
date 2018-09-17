<?php

namespace App\Controller;

use App\Entity\Donnateur;
use App\Form\DonnateurType;
use App\Repository\DonnateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/donnateur")
 */
class DonnateurController extends AbstractController
{
    /**
     * @Route("/", name="donnateur_index", methods="GET")
     */
    public function index(DonnateurRepository $donnateurRepository): Response
    {
        return $this->render('donnateur/index.html.twig', ['donnateurs' => $donnateurRepository->findAll()]);
    }

    /**
     * @Route("/new", name="donnateur_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $donnateur = new Donnateur();
        $form = $this->createForm(DonnateurType::class, $donnateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($donnateur);
            $em->flush();

            return $this->redirectToRoute('donnateur_index');
        }

        return $this->render('donnateur/new.html.twig', [
            'donnateur' => $donnateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donnateur_show", methods="GET")
     */
    public function show(Donnateur $donnateur): Response
    {
        return $this->render('donnateur/show.html.twig', ['donnateur' => $donnateur]);
    }

    /**
     * @Route("/{id}/edit", name="donnateur_edit", methods="GET|POST")
     */
    public function edit(Request $request, Donnateur $donnateur): Response
    {
        $form = $this->createForm(DonnateurType::class, $donnateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donnateur_edit', ['id' => $donnateur->getId()]);
        }

        return $this->render('donnateur/edit.html.twig', [
            'donnateur' => $donnateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donnateur_delete", methods="DELETE")
     */
    public function delete(Request $request, Donnateur $donnateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donnateur->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($donnateur);
            $em->flush();
        }

        return $this->redirectToRoute('donnateur_index');
    }
}
