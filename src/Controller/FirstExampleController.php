<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstExampleController extends AbstractController
{
    /**
     * @Route("/first/example", name="first_example")
     */
    public function index(): Response
    {
        return $this->render('first_example/index.html.twig', [
            'name' => 'Saidi AHAMADA',
        ]);
    }
}
