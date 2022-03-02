<?php

namespace App\Controller;

use App\Entity\PadreFamilia;
use App\Form\PadreFamiliaType;
use App\Repository\PadreFamiliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/padre/familia")
 */
class PadreFamiliaController extends AbstractController
{
    /**
     * @Route("/", name="app_padre_familia_index", methods={"GET"})
     */
    public function index(PadreFamiliaRepository $padreFamiliaRepository): Response
    {
        return $this->render('padre_familia/index.html.twig', [
            'padre_familias' => $padreFamiliaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_padre_familia_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PadreFamiliaRepository $padreFamiliaRepository): Response
    {
        $padreFamilium = new PadreFamilia();
        $form = $this->createForm(PadreFamiliaType::class, $padreFamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $padreFamiliaRepository->add($padreFamilium);
            return $this->redirectToRoute('app_padre_familia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('padre_familia/new.html.twig', [
            'padre_familium' => $padreFamilium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_padre_familia_show", methods={"GET"})
     */
    public function show(PadreFamilia $padreFamilium): Response
    {
        return $this->render('padre_familia/show.html.twig', [
            'padre_familium' => $padreFamilium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_padre_familia_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PadreFamilia $padreFamilium, PadreFamiliaRepository $padreFamiliaRepository): Response
    {
        $form = $this->createForm(PadreFamiliaType::class, $padreFamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $padreFamiliaRepository->add($padreFamilium);
            return $this->redirectToRoute('app_padre_familia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('padre_familia/edit.html.twig', [
            'padre_familium' => $padreFamilium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_padre_familia_delete", methods={"POST"})
     */
    public function delete(Request $request, PadreFamilia $padreFamilium, PadreFamiliaRepository $padreFamiliaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$padreFamilium->getId(), $request->request->get('_token'))) {
            $padreFamiliaRepository->remove($padreFamilium);
        }

        return $this->redirectToRoute('app_padre_familia_index', [], Response::HTTP_SEE_OTHER);
    }
}
