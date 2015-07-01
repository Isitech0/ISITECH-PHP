<?php

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Utilisateur;
use Doctrine\Common\Collections\ArrayCollection;
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

        $unutilisateur->setNom("Leydier");
        $unutilisateur->setPrenom("Josselin");
        $unutilisateur->setMail("josselin.leydier@gmail.com");
        $unutilisateur->setPassword("josselin123");

        $listeUtilisateur = new ArrayCollection();
        $listeUtilisateur->add($unutilisateur);


        return $this->render('isitechphpMainBundle:Default:Utilisateurs.html.twig', array('utilisateurs' => $listeUtilisateur->toArray()));
    }
}
