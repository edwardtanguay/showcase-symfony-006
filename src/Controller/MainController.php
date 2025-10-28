<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/info', name: 'app_info')]
    public function info(): Response
    {
        return new Response("the info");
    }

    #[Route('/change/{text}', name: 'app_change')]
    public function change( string $text): Response
    {
        return new Response('(extra data) ' . $text);
    }
}
