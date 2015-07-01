<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/07/2015
 * Time: 10:31
 */

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Article;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Droit;
use AppBundle\Entity\DroitRepository;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DaoGeneratorController  extends Controller {
    /**
     * @Route("/generate")
     * @Template()
     */
    public function indexAction()
    {
        $this->createDroit();
        $this->createArticle();

        $this->createUtilisateur();

        return array('DONE !');
    }

    /**
     * Créer des Droits
     */
    private function createDroit()
    {
        $droitCollection = new ArrayCollection();

        $undroit = new Droit();
        $undroit->setNom("admin");
        $undroit->setPriorite(0);

        $droitCollection->add($undroit);

        $undroit = new Droit();
        $undroit->setNom("user");
        $undroit->setPriorite(20);

        $droitCollection->add($undroit);

        $undroit = new Droit();
        $undroit->setNom("invite");
        $undroit->setPriorite(40);

        $droitCollection->add($undroit);

        $em = $this->getDoctrine()->getManager();

        // Enregistrement des droits
        foreach ($droitCollection as &$ledroit){
            $em->persist($ledroit);
            $em->flush();
        }
    }

    /**
     * Créer un article
     */
    private function createArticle()
    {
       $articleCollection = new \Doctrine\Common\Collections\ArrayCollection();

        $unArticle = new Article();
        $unArticle->setNom("CANNABIS");
        $unArticle->setPrix(90.6);
        $unArticle->setDescription("Catégorie: Perturbateurs/hallucinogènes
        Son nom usuel: Pot, mari, marijane, herbe, weed, joint, bat, billot, pétard, spliff, jig, skunk, kif, etc.");

        $articleCollection->add($unArticle);

        $unArticle = new Article();
        $unArticle->setNom("LSD");
        $unArticle->setPrix(90.6);
        $unArticle->setDescription("Catégorie : Perturbateurs/hallucinogènes Son nom usuel; Buvard, acide");

        $articleCollection->add($unArticle);

        $unArticle = new Article();
        $unArticle->setNom("AMPHÉTAMINES");
        $unArticle->setPrix(90.6);
        $unArticle->setDescription("Catégorie : Stimulants majeurs, Leur nom usuel : Speed, peanut, wake-up, pep pilule, pill, etc. Son surnom peut varier souvent en fonction de l’apparence du comprimé et du logo imprimé.");

        $articleCollection->add($unArticle);

        //  Ecrire en base
        $em = $this->getDoctrine()->getManager();

        // Enregistrement des Articles
        foreach ($articleCollection as &$larticle){
            $em->persist($larticle);
            $em->flush();
        }

    }

    /**
     * @return Response
     */
    private function createUtilisateur()
    {
        $newuser = new Utilisateur();
        $newuser->setNom('Ali');
        $newuser->setPrenom('_');
        $newuser->setPassword(hash('sha256', 'azertyuiop02'));
        $newuser->setMail('totommmm@toto.com');

        // Récupération de l'instance ORM
        $droitRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Droit');

        $newdroit = $droitRepository->find(1);
        $newuser->setDroit($newdroit);


        //        $dt = new DateTime();
        //       $newuser->setDescription('Test User' + $dt->format('Y-m-d H:i:s'));

        // Récupération de l'instance ORM
        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newuser);
        //$em->persist($newdroit);
        $em->flush();

        return new Response('Id du utilisateur créé : '.$newuser->getId());
    }
}