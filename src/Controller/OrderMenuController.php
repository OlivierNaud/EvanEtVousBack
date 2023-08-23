<?php

namespace App\Controller;

use App\Entity\OrderMenu;
use App\Form\OrderMenuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order-menu')]
class OrderMenuController extends AbstractController
{
    #[Route('/', name: 'app_order_menu_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $orderMenus = $entityManager
            ->getRepository(OrderMenu::class)
            ->findAll();

        return $this->render('order_menu/index.html.twig', [
            'order_menus' => $orderMenus,
        ]);
    }

    #[Route('/new', name: 'app_order_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orderMenu = new OrderMenu();
        $form = $this->createForm(OrderMenuType::class, $orderMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orderMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_order_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_menu/new.html.twig', [
            'order_menu' => $orderMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{menu}', name: 'app_order_menu_show', methods: ['GET'])]
    public function show(OrderMenu $orderMenu): Response
    {
        return $this->render('order_menu/show.html.twig', [
            'order_menu' => $orderMenu,
        ]);
    }

    #[Route('/{menu}/edit', name: 'app_order_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrderMenu $orderMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderMenuType::class, $orderMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_order_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_menu/edit.html.twig', [
            'order_menu' => $orderMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{menu}', name: 'app_order_menu_delete', methods: ['POST'])]
    public function delete(Request $request, OrderMenu $orderMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderMenu->getMenu(), $request->request->get('_token'))) {
            $entityManager->remove($orderMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
