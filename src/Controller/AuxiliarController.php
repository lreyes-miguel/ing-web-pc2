<?php

namespace App\Controller;

use App\Entity\Auxiliar;
use App\Form\AuxiliarType;
use App\Repository\AuxiliarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auxiliar")
 */
class AuxiliarController extends AbstractController
{
    /**
     * @Route("/", name="app_auxiliar_index", methods={"GET"})
     */
    public function index(AuxiliarRepository $auxiliarRepository): Response
    {
        return $this->render('auxiliar/index.html.twig', [
            'auxiliars' => $auxiliarRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_auxiliar_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AuxiliarRepository $auxiliarRepository): Response
    {
        $auxiliar = new Auxiliar();
        $form = $this->createForm(AuxiliarType::class, $auxiliar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auxiliarRepository->add($auxiliar);
            return $this->redirectToRoute('app_auxiliar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auxiliar/new.html.twig', [
            'auxiliar' => $auxiliar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_auxiliar_show", methods={"GET"})
     */
    public function show(Auxiliar $auxiliar): Response
    {
        return $this->render('auxiliar/show.html.twig', [
            'auxiliar' => $auxiliar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_auxiliar_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Auxiliar $auxiliar, AuxiliarRepository $auxiliarRepository): Response
    {
        $form = $this->createForm(AuxiliarType::class, $auxiliar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auxiliarRepository->add($auxiliar);
            return $this->redirectToRoute('app_auxiliar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auxiliar/edit.html.twig', [
            'auxiliar' => $auxiliar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_auxiliar_delete", methods={"POST"})
     */
    public function delete(Request $request, Auxiliar $auxiliar, AuxiliarRepository $auxiliarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auxiliar->getId(), $request->request->get('_token'))) {
            $auxiliarRepository->remove($auxiliar);
        }

        return $this->redirectToRoute('app_auxiliar_index', [], Response::HTTP_SEE_OTHER);
    }
}
