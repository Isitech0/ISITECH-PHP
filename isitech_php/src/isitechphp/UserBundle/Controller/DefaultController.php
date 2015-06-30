<?php

namespace isitechphp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    public function createUser()
    {
        $newuser = new Utilisateur();
        $newuser->setName('Alexis');
        $newuser->setPassword(hash('sha256', 'azertyuiop'));
        $newuser->setDescription('TEST ');

        //        $dt = new DateTime();
        //       $newuser->setDescription('Test User' + $dt->format('Y-m-d H:i:s'));

        // Récupération de l'instance ORM
        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newuser);
        $em->flush();

        return new Response('Id du utilisateur créé : '.$newuser->getId());
    }

    public function dropAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $newuser = $em->getRepository('UserBundle:Utilisateur')->find($id);

        if (!$newuser) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé pour cet id : '.$id
            );
        }

        $em->remove($newuser);
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }

    function addComment($idCom, $idUser, $message){
        $em = $this->getDoctrine()->getManager();
        //$newcomment = $em->getRepository('UserBundle:')
    }
}
