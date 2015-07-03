<?php

namespace isitechphp\AdminBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use isitechphp\AdminBundle\Entity\Task;
use isitechphp\AdminBundle\Controller\Form;


class AdminController extends Controller
{
    /**
     * @Route("/admin/users", name="userscontrol")
     * @Template()
     */
    public function usersAction()
    {
        return $this->render('isitechphpAdminBundle:Admin:users.html.twig', array('utilisateurs' => $this->showUsers()));
    }

    public function showUsers(){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        return $repository->findAll();
    }

    /**
     * @Route("/admin/articles", name="articlescontrol")
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
     * @Route("/admin/setright", name="setright")
     * @Template()
     */
    public function setRight($iduser, $droit){
        $unuser = new User($iduser);
        $unuser->setDroit($droit);
        //pareilavec fonction danscontroller User
    }
    /**
     * @Route("/admin/addproduct", name="addproduct")
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
    /**
     * @Route("/admin/removeuser/{idUser}", name="removeuser")
     * @Template()
     */
    public function removeUser($idUser)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Utilisateur')->find($idUser);
        if (!$user) {
            throw $this->createNotFoundException(
                'Aucun Utilisateur trouvé pour cet id : '.$idUser
            );
        }
        $em->remove($user);
        $em->flush();
    }
 }
