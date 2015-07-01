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

        $unutilisateur= new Article();
        $unutilisateur->id = 1;
        $unutilisateur->nom = "Leydier";
        $unutilisateur->prenom = "Josselin";
        $unutilisateur->mail = "josselin.leydier@gmail.com";
        $unutilisateur->password ="josselin123";

        $articles = array($unutilisateur);

        //return $this->render('isitechphpMainBundle:Default:ArticleView.html.twig', array('articles' => $articles));
    }
}
