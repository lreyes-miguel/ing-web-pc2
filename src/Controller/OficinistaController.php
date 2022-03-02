<?php

namespace App\Controller;

use App\Entity\Oficinista;
use App\Form\OficinistaType;
use App\Repository\OficinistaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/oficinista")
 */
class OficinistaController extends AbstractController
{
    /**
     * @Route("/", name="app_oficinista_index", methods={"GET"})
     */
    public function index(OficinistaRepository $oficinistaRepository): Response
    {
        return $this->render('oficinista/index.html.twig', [
            'oficinistas' => $oficinistaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_oficinista_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OficinistaRepository $oficinistaRepository): Response
    {
        $oficinistum = new Oficinista();
        $form = $this->createForm(OficinistaType::class, $oficinistum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oficinistaRepository->add($oficinistum);
            return $this->redirectToRoute('app_oficinista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('oficinista/new.html.twig', [
            'oficinistum' => $oficinistum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_oficinista_show", methods={"GET"})
     */
    public function show(Oficinista $oficinistum): Response
    {
        return $this->render('oficinista/show.html.twig', [
            'oficinistum' => $oficinistum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_oficinista_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Oficinista $oficinistum, OficinistaRepository $oficinistaRepository): Response
    {
        $form = $this->createForm(OficinistaType::class, $oficinistum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oficinistaRepository->add($oficinistum);
            return $this->redirectToRoute('app_oficinista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('oficinista/edit.html.twig', [
            'oficinistum' => $oficinistum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_oficinista_delete", methods={"POST"})
     */
    public function delete(Request $request, Oficinista $oficinistum, OficinistaRepository $oficinistaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oficinistum->getId(), $request->request->get('_token'))) {
            $oficinistaRepository->remove($oficinistum);
        }

        return $this->redirectToRoute('app_oficinista_index', [], Response::HTTP_SEE_OTHER);
    }
}
