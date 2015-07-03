<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/07/2015
 * Time: 09:35
 */
namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\AlertBootStrap;
use AppBundle\Entity\Article;
use AppBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ArticleController extends Controller {
    /**
     * @Route("/articles", name="articles")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('isitechphpMainBundle:Default:ArticleView.html.twig', array('articles' => $this->selectArticle()));
    }

    /**
     * Retroune tous les articles de la BDD
     */
    private function selectArticle()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        return $repository->findAll();
    }

    /**
     * Selectionner un Article avec tous ses commentaires
     * @Route("/articlescommentaires/{article}", name="articlescommentaires")
     * @Template()
     */
    public function selectCommentAction(Article $article)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Commentaire');

        $commentaireList = $repository->findByArticle(array('article_id' => $article->getId()));

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        $article = $repository->find($article->getId());

        $session = new Session();
        $noteSession = $session->get('note');

    //      var_dump($noteSession);
    //        var_dump(ArticleController::isundefined($noteSession));

        // Si une note existe on l'affiche
        if(ArticleController::isundefined($noteSession))
            return $this->render('isitechphpMainBundle:Default:ArticleCommentsView.html.twig', array('articles' => $article, 'comments' => $commentaireList ));
        else {
            $session->remove('note');

            return $this->render('isitechphpMainBundle:Default:ArticleCommentsView.html.twig', array('articles' => $article, 'comments' => $commentaireList, 'note' => $noteSession));
        }
    }

    /**
     * Créer un nouveau commentaire
     * @Route("/postercommentaire/{article}", name="postercommentaire")
     * @Template()
     */
    public function posterCommentaireAction(Article $article)
    {
        // Récupération de l'article
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        $article = $repository->find($article->getId());

        // Récupération de l'utilisateur
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        $session = new Session();
        $user = $session->get('user');

        // Si l'utilisateur existe
        if($this->is_undefined($user) != false)
        {
            $user = $repository->find($user->getId());
            //$user = $repository->find(1);

            // Création du nouveau commentaire
            $comment = new Commentaire();

            $comment->setArticle($article);
            $comment->setUser($user);

            $date = new \DateTime();

            $comment->setDate($date->format('Y-m-d H:i:s'));
            $comment->setNote(trim($_POST['commentBox']));

            $em = $this->getDoctrine()->getManager();

            // Enregistrement de commentaire
            $em->persist($comment);
            $em->flush();

            // Rafraichir la liste des commentaires
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Commentaire');

            $commentaireList = $repository->findByArticle(array('article_id' => $article->getId()));

            // Création de l'alerte
            $newnote = new AlertBootStrap();
            $newnote->setMessage("Commentaire posté");
            $newnote->setType("success");

            $session->set('note', $newnote);
        }

       // Retourner sur la route /articlescommentaires
       return $this->redirect($this->generateUrl('articlescommentaires', array('article' => $article->getId())));
    }

    /**
     * Méthode pour vérifier si un objet est null
     * @param $test
     * @return bool
     * TODO PB AVEC is_undefined pour la session
     */
    private function is_undefined(&$test) {
        return isset($test) && !is_null($test);
    }

    /**
     * @param $test
     * @return bool
     * TODO PB AVEC cette méthode pour un objet classi
     */
    public static function isundefined($test) {
        return empty($test) && !isset($test);
    }

    /**
     * Supprimer un article
     * @Route("/supprimerarticle/{article}", name="supprimerarticle")
     * @Template()
     */
    public function removeArticleAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->find($article->getId());

        if (!$article) {
            throw $this->createNotFoundException(
                'Aucun Article trouvé pour cet id : '.$id
            );
        }

        $em->remove($article);
        $em->flush();

        // Retourner sur la route /articles
        return $this->redirect($this->generateUrl('articles', array('articles' => $this->selectArticle())));
    }

    /**
     * Supprimer un commentaire
     * @Route("/supprimercommentaire/{commentaire}", name="supprimercommentaire")
     * @Template()
     */
    public function removeCommentaireAction(Commentaire $commentaire)
    {
        $em = $this->getDoctrine()->getManager();
        $commentairebase = $em->getRepository('AppBundle:Commentaire')->find($commentaire->getId());

        if (!$commentairebase) {
            throw $this->createNotFoundException(
                'Aucun commentaire trouvé pour cet id : '.$commentaire->getId()
            );
        }

        $em->remove($commentairebase);
        $em->flush();

        // Retourner sur la route /articlescommentaires
        return $this->redirect($this->generateUrl('articlescommentaires', array('article' => $commentaire->getArticle()->getId() )));
    }

    /**
     * Example article_add
     * @Route("/article_add", name="articleadd")
     * @return Response
     */
    public function article_add()
    {
        return $this->render('isitechphpMainBundle:Default:ArticleAdd.html.twig');
    }

    /**
     * Example article_db
     * @Route("/article_db", name="articledb")
     * @return Response
     */
    public function article_db()
    {
        $newArticle = new Article();
        $newArticle->setNom(trim($_POST['nom']));
        $newArticle->setPrix(trim (trim($_POST['prix'])));
        $newArticle->setDescription(trim($_POST['description']));
        $newArticle->setUrlImage(trim($_POST['url']));

        $currentArticle = $_POST['nom'];
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');
        $compareArticle = $repository->findOneBy(array('nom' => $currentArticle));

        if ($compareArticle != Null)
        {

            ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Erreur!</strong> Cet article existe déjà!
            </div>
            <?php

            //return $this->render('isitechphpMainBundle:Default:ArticleAdd.html.twig');
            // Retourner sur la route /articles
            return $this->redirect($this->generateUrl('articles', array('articles' => $this->selectArticle())));
        }

        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newArticle);
        $em->flush();


        ?>
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Succès!</strong> L'article a bien été créé.
        </div>
        <?php

        //return $this->render('isitechphpMainBundle:Default:ArticleAdd.html.twig');
        // Retourner sur la route /articles
        return $this->redirect($this->generateUrl('articles', array('articles' => $this->selectArticle())));
    }

    private function cast($destination, $sourceObject)
    {
        if (is_string($destination)) {
            $destination = new $destination();
        }
        $sourceReflection = new ReflectionObject($sourceObject);
        $destinationReflection = new ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination,$value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }
}