<?php

namespace isitechphp\AdminBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('isitechphpAdminBundle:Admin:index.html.twig', array('utilisateurs' => $this->showUsers()));
    }

    public function showUsers(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        return $repository->findAll();
    }

    /**
     * @Route("/admin/articles", name="articles")
     * @Template()
     */
    public function articlesAction()
    {
        return $this->render('isitechphpAdminBundle:Admin:articles.html.twig', array('articles' => $this->showArticles()));
    }

    public function showArticles(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        return $repository->findAll();
    }

    /**
     * @Route("/admin/removeuser")
     * @Template()
     */
    public function removeUser($id){
      //  \AppBundle\Entity\ $removeUser($this);
      //  $yc = $this->get('Utilisateur');
        return array('name' => $id);
    }

    public function setRight($iduser, $droit){
        $unuser = new User($iduser);
        $unuser->setDroit($droit);
        //pareilavec fonction danscontroller User
    }
    /**
     * @Route("/admin/addproduct")
     * @Template()
     */
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

    }


}
