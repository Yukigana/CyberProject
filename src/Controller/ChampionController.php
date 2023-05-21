<?php

namespace App\Controller;

use App\Entity\MainZone;
use App\Entity\SousZone;
use App\Entity\Personnage;
use App\Entity\Implant;
use App\Entity\Champion;
use App\Entity\asso_champion_implant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('', name: 'champion')]
class ChampionController extends AbstractController
{
    #[Route('/listeChampions', name: '_listeChampions')]
    public function listeChampionAction(EntityManagerInterface $em): Response
    {
        // On récupère l'ensemble des champions de la table
        $championRepository = $em->getRepository(Champion::class);
        $champions = $championRepository->findAll();

        // On stock les champions pour les envoyer vers le template
        $args = array(
            'champions' => $champions,
        );

        return $this->render('Database/ListeChampions.html.twig', $args);
    }


    #[Route('/champion/{id_champion}', 
        name: '_champion',
        requirements: [
        'id_champion' => '[1-9]\d*',
        ],
    )]
    public function championAction(int $id_champion, EntityManagerInterface $em): Response
    {
        // On récupère le champion correspondant à id_champion
        $championRepository = $em->getRepository(Champion::class);
        $champion = $championRepository->find($id_champion);


        $args = array(
            'champion' => $champion,
            'implants' => $champion->getImplant(),
        );

        return $this->render('Database/FicheChampion.html.twig', $args);
    }
}
