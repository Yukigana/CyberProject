<?php

namespace App\Controller;

use App\Entity\SousZone;
use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('', name: 'personnage')]
class PersonnageController extends AbstractController
{
    
    #[Route('/listePersonnages', name: '_listePersonnages')]
    public function listePersonnagesAction(EntityManagerInterface $em): Response
    {

        // Création des tableaux qui stockerons les personnages en fonction de leur type
        $args = array(
            'marchants' => array(),
            'quete' => array(),
            'divers' => array(),
        );

        //Récupération de l'ensemble des personnages de la table Personnage 
        $personnageRepository = $em->getRepository(Personnage::class);
        $personnages = $personnageRepository->findAll();


        //Pour chaque personnage on vérifie son type afin de le stocker au bon endroit 
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
        //On récupère le personnage à partir de son id
        $personnageRepository = $em->getRepository(Personnage::class);
        $perso = $personnageRepository->find($id_perso); //récupération du personnage possèdant l'id id_perso

        $args = array(
            'perso' => $perso,
            'zone' => $perso->getSousZone(),
        );

        return $this->render('Database/FichePerso.html.twig', $args);
    }
}
