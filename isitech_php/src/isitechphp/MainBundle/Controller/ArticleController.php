<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/07/2015
 * Time: 09:35
 */
namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArticleController extends Controller {
    /**
     * @Route("/articles")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('isitechphpMainBundle:Default:ArticleView.html.twig', array('articles' => $this->selectArticle()));
    }

    public function selectArticle()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        return $repository->findAll();
    }
}