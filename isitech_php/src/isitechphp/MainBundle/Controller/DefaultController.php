<?php

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hellov2")
     * @Template()
     */
    public function indexAction()
    {
        //$articles = array();
        $unarticle = new Article();

       // $unarticle->id = 1;
        $unarticle->setNom("Shit");
        $unarticle->setDescription("pas bien");

        $articles = array($unarticle);

        return $this->render('isitechphpMainBundle:Default:ArticleView.html.twig', array('articles' => $articles));
    }
}
