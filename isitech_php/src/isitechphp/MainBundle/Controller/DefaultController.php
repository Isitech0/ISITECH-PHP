<?php

namespace isitechphp\MainBundle\Controller;

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
        return array('name');
    }

    /**
     * Example homepage
     * @Route("/", name="homepagev2")
     * @return Response
     */
    public function homepage()
    {
        return $this->render('isitechphpMainBundle:Default:index.html.twig', array('articles' => $this->selectArticle()));
    }


    /**
     * Retroune tous les articles de la BDD
     */
    private function selectArticle()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        return $repository->findAll();
    }
}