<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'overview')]
class OverviewController extends AbstractController
{
    #[Route('', name: '_accueil')]
    public function accueilAction(): Response
    {
        return $this->render('Overview/Accueil.html.twig');
    }


    #[Route('/aventure', name: '_aventure')]
    public function aventureAction(): Response
    {
        return $this->render('Overview/Aventure.html.twig');
    }
}
