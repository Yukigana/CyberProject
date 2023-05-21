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

#[Route('', name: 'implant')]
class ImplantController extends AbstractController
{
    

    #[Route('/listeImplant', name: '_listeImplant')]
    public function listeImplantAction(EntityManagerInterface $em): Response
    {
        // Création des tableaux qui stockerons les implants en fonction de leur type
        $args = array(
            'actif' => array(),
            'passif' => array(),
        );

        //Récupération de l'ensemble des implants de la table Implant 
        $implantRepository = $em->getRepository(Implant::class);
        $implants = $implantRepository->findAll();

        //Pour chaque implant on vérifie son type afin de le stocker au bon endroit 
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
        //On récupère l'implant à partir de son id
        $implantRepository = $em->getRepository(Implant::class);
        $implant = $implantRepository->find($id_implant);

        $args = array(
            'implant' => $implant,
            'zone' => $implant->getSousZone(),
        );

        return $this->render('Database/FicheImplant.html.twig', $args);
    }
}