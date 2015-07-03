<?php
namespace isitechphp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use isitechphp\AdminBundle\Entity\Form;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FormController extends Controller
{
    /**
     * @Route("/admin/form/{id}", name="supprimerutilisateur")
     * @Template()
     */
    public function newAction(Request $request, $iduser)
    {
        // remove database

        //
           return $this->redirect($this->generateUrl('removeuser', array('iduser' => $iduser)));
            //return $this->redirect($this->generateUrl('homepagev2'));
    }
}
