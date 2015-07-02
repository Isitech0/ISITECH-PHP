<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/07/2015
 * Time: 10:31
 */

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Commentaire;
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

    // lance toutes les fonctions qui permettent de remplir la base
    /**
     * @Route("/generate")
     * @Template()
     */
    public function indexAction()
    {
        $this->createDroit();
        $this->createArticle();
        $this->createUtilisateur();
        $this->createCommentaire();

        return array('DONE !');
    }


    // ajoute des droits à la base
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

    // ajoute des articles à la base
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


        $unArticle = new Article();
        $unArticle->setNom("ALCOOL");
        $unArticle->setPrix(10);
        $unArticle->setDescription("Catégorie : Dépresseurs, nom usuel : Drink, boisson, fort, Qu’est-ce que c’est ? L’alcool est obtenu par la fermentation de certains fruits ou certaines céréales ou par la distillation. Il fait partie de la famille des dépresseurs, c’est-à-dire qu’il agit sur le système nerveux central en engourdissant le cerveau et en ralentissant le fonctionnement du corps.
        Son apparence : On retrouve l’alcool sous forme liquide dans diverses boissons : bière, « coolers », vin, cidre, apéritifs, digestifs et spiritueux.
        Ses effets : L’alcool engourdit le cerveau et déséquilibre le comportement et la coordination des mouvements.L’effet de l’alcool se fera sentir plus vite s’il est consommé à jeun ou trop rapidement. Son effet se fera aussi sentir plus rapidement chez une personne de petite taille ou fatiguée. Enfin, il faut savoir que l’effet de l’alcool est influencé par l’interaction de trois facteurs : la personne, le contexte et le produit.");

        $articleCollection->add($unArticle);

        $unArticle = new Article();
        $unArticle->setNom("COCAÏNE");
        $unArticle->setPrix(20);
        $unArticle->setDescription("Catégorie : Stimulants majeurs Son nom usuel : Coke, poudre, coco, coca, snow La cocaïne provoque : une contraction des vaisseaux sanguins; une irrégularité du rythme cardiaque; de l’hypertension artérielle  Elle procure : une euphorie; une impression de puissance.");

        $articleCollection->add($unArticle);

        //  Ecrire en base
        $em = $this->getDoctrine()->getManager();

        // Enregistrement des Articles
        foreach ($articleCollection as &$larticle){
            $em->persist($larticle);
            $em->flush();
        }

    }
    // ajoute des utilisateurs en base
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

    $newuser1 = new Utilisateur();
    $newuser1->setNom('Alexis');
    $newuser1->setPrenom('2');
    $newuser1->setPassword(hash('sha256', 'azertyuiop02'));
    $newuser1->setMail('m@toto.com');

    $newuser2 = new Utilisateur();
    $newuser2->setNom('guillaume');
    $newuser2->setPrenom('aume');
    $newuser2->setPassword(hash('sha256', 'azertyuiop02'));
    $newuser2->setMail('totm@toto.com');

    $newuser3 = new Utilisateur();
    $newuser3->setNom('Jeremy');
    $newuser3->setPrenom('my');
    $newuser3->setPassword(hash('sha256', 'azertyuiop02'));
    $newuser3->setMail('toee@toto.com');

    // Récupération de l'instance ORM
    $droitRepository = $this->getDoctrine()
        ->getRepository('AppBundle:Droit');

    $newdroit = $droitRepository->find(1);
    $newuser->setDroit($newdroit);
    $newuser1->setDroit($newdroit);
    $newuser2->setDroit($newdroit);
    $newuser3->setDroit($newdroit);


    //        $dt = new DateTime();
    //       $newuser->setDescription('Test User' + $dt->format('Y-m-d H:i:s'));

    // Récupération de l'instance ORM
    $em = $this->getDoctrine()->getManager();

    // Enregistrement de l'utilisateur
    $em->persist($newuser);
    $em->persist($newuser1);
    $em->persist($newuser2);
    $em->persist($newuser3);
    //$em->persist($newdroit);
    $em->flush();

    // return new Response('Id du utilisateur créé : '.$newuser->getId());

}

    // ajoute des commentaires en base
    private function createCommentaire()
    {
        $newcom = new Commentaire();
        $newcom->setNote('le canabis avant de dormir c est top');
        $newcom->setDate('10/06/2015');

        $newcom1 = new Commentaire();
        $newcom1->setNote('j adore la coc');
        $newcom1->setDate('01/06/2015');

        $newcom2 = new Commentaire();
        $newcom2->setNote('pas d alcool au volant');
        $newcom2->setDate('21/05/2015');


        // Récupération de l'instance ORM
        $articleRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        $newArticle = $articleRepository->find(1);
        $newcom->setArticle($newArticle);

        $newArticle1 = $articleRepository->find(5);
        $newcom1->setArticle($newArticle1);

        $newArticle2 = $articleRepository->find(4);
        $newcom2->setArticle($newArticle2);


        // Récupération de l'instance ORM
        $utilisateurRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        $newUtilisateur = $utilisateurRepository->find(1);
        $newcom->setUser($newUtilisateur);

        $newUtilisateur1 = $utilisateurRepository->find(1);
        $newcom1->setUser($newUtilisateur1);

        $newUtilisateur2 = $utilisateurRepository->find(2);
        $newcom2->setUser($newUtilisateur2);


        // Récupération de l'instance ORM
        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newcom);
        $em->persist($newcom1);
        $em->persist($newcom2);

        $em->flush();

    }
}