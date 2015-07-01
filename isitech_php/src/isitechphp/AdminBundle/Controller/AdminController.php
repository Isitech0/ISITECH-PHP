<?php

namespace isitechphp\AdminBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

//    public function removeUser($id){
//        \AppBundle\Entity\ $removeUser($this);
//        $yc = $this->get('Utilisateur');
//    }

    public function setRight($iduser, $droit){
        $unuser = new User($iduser);
        $unuser->setDroit($droit);
        //pareilavec fonction danscontroller User
    }

    public function addproduct($name,$price,$desc){
        $art = new Article();
        $art->setNom($name);
        $art->setPrix($price);
        $art->setDescription($desc);

        // Récupération de l'instance ORM
        $orm = $this->getDoctrine()->getManager();

        // Enregistrement de l'article
        $orm->persist($art);
        $orm->flush();

        return new Response('Article créé : '.$art->getId());

    }

    public function removeProduct(){
        //get connection
        $conn = $this->get('database_connection');
        //run a query
        $foo= $conn->fetchAll('select * from foo');
    }

}
