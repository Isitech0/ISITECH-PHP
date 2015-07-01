<?php

namespace isitechphp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UtilisateursController extends Controller
{
    /**
     * @Route("/hellov4")
     * @Template()
     */
    public function indexAction()
    {

        $unutilisateur= new Utilisateur();

        $unutilisateur->getId("1");
        $unutilisateur->setNom("Leydier");
        $unutilisateur->setPrenom("Josselin");
        $unutilisateur->getMail("josselin.leydier@gmail.com");
        $unutilisateur->getPassword("josselin123");

        $utilisateur = ArrayCollection($unutilisateur);

        return $this->render('isitechphpMainBundle:Default:Utilisateurs.html.twig', array('utilisateur' => $unutilisateur));
    }
}
