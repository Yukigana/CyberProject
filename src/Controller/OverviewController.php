<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('', name: 'overview')]
class OverviewController extends AbstractController
{
    #[Route('/', name: '')]
    public function defaultAction(): Response
    {
        return new RedirectResponse($this->generateUrl('overview_accueil'));
    }
    
    #[Route('/accueil', name: '_accueil')]
    public function accueilAction(): Response
    {
        return $this->render('Overview/Accueil.html.twig');
    }

    #[Route('/info', name: '_info')]
    public function infoAction(): Response
    {
        return $this->render('Overview/Information.html.twig');
    }

    #[Route('/aventure', name: '_aventure')]
    public function aventureAction(): Response
    {
        return $this->render('Overview/Aventure.html.twig');
    }

    #[Route('/duel', name: '_duel')]
    public function duelAction(): Response
    {
        return $this->render('Overview/Duel.html.twig');
    }
}
