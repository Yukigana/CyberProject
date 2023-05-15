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

#[Route('', name: 'database')]
class DatabaseController extends AbstractController
{
    
    #[Route('/listZone', name: '_listZone')]
    public function listZoneAction(EntityManagerInterface $em): Response
    {

        $args = array(
            'zone' => array(),
        );


        $mainZoneRepository = $em->getRepository(MainZone::class);
        $mainZone = $mainZoneRepository->findAll();

        $sousZoneRepository = $em->getRepository(SousZone::class);
        $sousZone = $sousZoneRepository->findAll();

        foreach($mainZone as $zone){
            $sousZoneArray = array();

            foreach($sousZone as $sZone){
                if($sZone->getMainZone()->getId() == $zone->getId()){
                    array_push($sousZoneArray, $sZone);
                }
            }

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
        $sousZoneRepository = $em->getRepository(SousZone::class);
        $sousZone = $sousZoneRepository->find($id_zone);

        $args = array(
            'zone' => $sousZone,
        );

        return $this->render('Database/FicheZone.html.twig', $args);
    }



    #[Route('/listePersonnages', name: '_listePersonnages')]
    public function listePersonnagesAction(EntityManagerInterface $em): Response
    {

        $args = array(
            'marchants' => array(),
            'quete' => array(),
            'divers' => array(),
        );


        $personnageRepository = $em->getRepository(Personnage::class);
        $personnages = $personnageRepository->findAll();


        foreach($personnages as $perso){

            if($perso->getType() == 'marchant'){
                array_push($args['marchants'], $perso);
            }
            elseif($perso->getType() == 'quete'){
                array_push($args['quete'], $perso);
            }
            else{
                array_push($args['divers'], $perso);
            }
        }

        return $this->render('Database/ListePersonnages.html.twig', $args);
    }

    #[Route('/perso/{id_perso}', 
        name: '_perso',
        requirements: [
        'id_perso' => '[1-9]\d*',
        ],
    )]
    public function persoAction(int $id_perso, EntityManagerInterface $em): Response
    {
        $personnageRepository = $em->getRepository(Personnage::class);
        $perso = $personnageRepository->find($id_perso);

        $args = array(
            'perso' => $perso,
            'zone' => $perso->getSousZone(),
        );

        return $this->render('Database/FichePerso.html.twig', $args);
    }


    #[Route('/listeImplant', name: '_listeImplant')]
    public function listeImplantAction(EntityManagerInterface $em): Response
    {

        $args = array(
            'actif' => array(),
            'passif' => array(),
        );


        $implantRepository = $em->getRepository(Implant::class);
        $implants = $implantRepository->findAll();


        foreach($implants as $implant){

            if($implant->getType() == 'actif'){
                array_push($args['actif'], $implant);
            }
            else{
                array_push($args['passif'], $implant);
            }
        }

        return $this->render('Database/ListeImplants.html.twig', $args);
    }

    #[Route('/implant/{id_implant}', 
        name: '_implant',
        requirements: [
        'id_implant' => '[1-9]\d*',
        ],
    )]
    public function implantAction(int $id_implant, EntityManagerInterface $em): Response
    {
        $implantRepository = $em->getRepository(Implant::class);
        $implant = $implantRepository->find($id_implant);

        $args = array(
            'implant' => $implant,
            'zone' => $implant->getSousZone(),
        );

        return $this->render('Database/FicheImplant.html.twig', $args);
    }



    #[Route('/listeChampions', name: '_listeChampions')]
    public function listeChampionAction(EntityManagerInterface $em): Response
    {
        $championRepository = $em->getRepository(Champion::class);
        $champions = $championRepository->findAll();

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
        $championRepository = $em->getRepository(Champion::class);
        $champion = $championRepository->find($id_champion);


        $args = array(
            'champion' => $champion,
            'implants' => $champion->getImplant(),
        );

        return $this->render('Database/FicheChampion.html.twig', $args);
    }
}
