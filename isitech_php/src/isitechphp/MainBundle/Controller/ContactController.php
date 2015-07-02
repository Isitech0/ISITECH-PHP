<?php

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Utilisateur;
//use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function contactAction()
    {
        return $this->render('isitechphpMainBundle:Default:contact.html.twig');
    }

}