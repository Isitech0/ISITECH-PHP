<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/07/2015
 * Time: 09:35
 */
namespace isitechphp\MainBundle\Controller;

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

        return $this->render('isitechphpMainBundle:Default:ArticleCommentsView.html.twig', array('articles' => $article, 'comments' => $commentaireList ));
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
        }

       return $this->redirect($this->generateUrl('articlescommentaires', array('article' => $article->getId() )));
       //return $this->render('isitechphpMainBundle:Default:ArticleCommentsView.html.twig', array('articles' => $article, 'comments' => $commentaireList ));
    }

    private function is_undefined(&$test) {
        return isset($test) && !is_null($test);
    }
}