<?php

namespace App\Controller;

use App\Entity\Van;
use App\Form\VanType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/van')]
class VanController extends AbstractController
{
    #[Route('/', name: 'app_van_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vans = $entityManager
            ->getRepository(Van::class)
            ->findAll();

        return $this->render('van/index.html.twig', [
            'vans' => $vans,
        ]);
    }

    #[Route('/new', name: 'app_van_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $van = new Van();
        $form = $this->createForm(VanType::class, $van);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($van);
            $entityManager->flush();

            return $this->redirectToRoute('app_van_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('van/new.html.twig', [
            'van' => $van,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_van_show', methods: ['GET'])]
    public function show(Van $van): Response
    {
        return $this->render('van/show.html.twig', [
            'van' => $van,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_van_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Van $van, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VanType::class, $van);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_van_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('van/edit.html.twig', [
            'van' => $van,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_van_delete', methods: ['POST'])]
    public function delete(Request $request, Van $van, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$van->getId(), $request->request->get('_token'))) {
            $entityManager->remove($van);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_van_index', [], Response::HTTP_SEE_OTHER);
    }
}
