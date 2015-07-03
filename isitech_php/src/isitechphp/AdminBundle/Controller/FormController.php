<?php
namespace isitechphp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use isitechphp\AdminBundle\Entity\Form;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FormController extends Controller
{
    /**
     * Appelle le controleur pour supprimer utilisateur
     * @Route("/admin/form/{id}", name="supprimerutilisateur")
     * @Template()
     */
    public function newAction(Request $request, $iduser)
    {
           return $this->redirect($this->generateUrl('removeuser', array('iduser' => $iduser)));
    }
}
