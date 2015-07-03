<?php

namespace isitechphp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use isitechphp\AdminBundle\Controller\Form;


class AdminController extends Controller
{
    /**
     * Listing des utilisateurs
     * @Route("/admin/users", name="userscontrol")
     * @Template()
     */
    public function usersAction()
    {
        return $this->render('isitechphpAdminBundle:Admin:users.html.twig', array('utilisateurs' => $this->showUsers()));
    }

    /**
     * Retroune tout les utilisateurs de la BDD
     */
    public function showUsers(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');
        return $repository->findAll();
    }

    /**
     * Supprime utilisateur via son id
     * @Route("/admin/removeuser/{iduser}", name="removeuser")
     * @Template()
     */
    public function removeuserAction($iduser)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Utilisateur')->find($iduser);
        if (!$user) {
            throw $this->createNotFoundException(
                'Aucun Utilisateur trouvé pour cet id : '.$iduser
            );
        }
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('userscontrol'));
    }
 }
