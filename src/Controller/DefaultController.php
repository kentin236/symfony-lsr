<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(path="/default", name="default", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route(path="/default/homepage", name="default_homepage", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function homepage(Request $request): Response
    {
        return $this->render('default/homepage.html.twig', [
            'query' => $request->query->all()
        ]);
    }
}
