<?php

namespace App\Controller;

use App\Entity\MainZone;
use App\Entity\SousZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('', name: 'zone')]
class ZoneController extends AbstractController
{
    
    #[Route('/listZone', name: '_listZone')]
    public function listZoneAction(EntityManagerInterface $em): Response
    {

        $args = array(
            'zone' => array(),
        );

        //Récupération de toutes les zones principales
        $mainZoneRepository = $em->getRepository(MainZone::class);
        $mainZone = $mainZoneRepository->findAll();

        //Récupération de toutes les sous-zones
        $sousZoneRepository = $em->getRepository(SousZone::class);
        $sousZone = $sousZoneRepository->findAll();

        //Pour chaque zone principale on récupère l'ensemble de ses sous-zones 
        foreach($mainZone as $zone){
            $sousZoneArray = array();

            //Pour chaque sous-zone on vérifie si elle est liée à la zone principale actuel
            foreach($sousZone as $sZone){
                //Si oui on la rajoute
                if($sZone->getMainZone()->getId() == $zone->getId()){
                    array_push($sousZoneArray, $sZone);
                }
            }

            //Puis on stock la zone principale avec ses sous-zones 
            $data = array(
                'mainZone' => $zone,
                'sousZone' => $sousZoneArray,
            );

            array_push($args['zone'], $data);
        }

        return $this->render('Database/ListZone.html.twig', $args);
    }

    #[Route('/zone/{id_zone}', 
        name: '_zone',
        requirements: [
        'id_zone' => '[1-9]\d*',
        ],
    )]
    public function zoneAction(int $id_zone, EntityManagerInterface $em): Response
    {
        //On récupère la sous-zone à partir de son id
        $sousZoneRepository = $em->getRepository(SousZone::class);
        $sousZone = $sousZoneRepository->find($id_zone);

        $args = array(
            'zone' => $sousZone,
        );

        return $this->render('Database/FicheZone.html.twig', $args);
    }
}
