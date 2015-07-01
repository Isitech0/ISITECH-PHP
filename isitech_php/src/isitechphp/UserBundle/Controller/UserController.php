<?php

namespace isitechphp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/users")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    public function createUser($name, $pass, $desc)
    {
        $newuser = new Utilisateur();
        $newuser->setName($name);
        $newuser->setPassword(hash('sha256', $pass));
        $newuser->setDescription($desc);

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

    public function setRight($id, $droit){
        $em = $this->getDoctrine()->getManager();
        $newuser = $em->getRepository('UserBundle:Utilisateur')->find($id);

        if (!$newuser) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé pour cet id : '.$id
            );
        }

        $newuser->setDroit($droit);
        $em->flush();
    }

    public function removeComment($idCom){
        $em = $this->getDoctrine()->getManager();
        $com = $em->getRepository('UserBundle:Commentaire')->find($idCom);
        if (!$com) {
            ²
    function addComment($idCom, $idUser, $message){

        $em = $this->getDoctrine()->getManager();
        //$newcomment = $em->getRepository('UserBundle:')
    }
}
