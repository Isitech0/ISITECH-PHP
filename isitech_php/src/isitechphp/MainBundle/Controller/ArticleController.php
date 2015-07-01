<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/07/2015
 * Time: 09:35
 */
namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;

class ArticleController extends Controller {
    /**
     * @Route("/articles", name="articles")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('isitechphpMainBundle:Default:ArticleView.html.twig', array('articles' => $this->selectArticle()));
    }

    private function selectArticle()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        return $repository->findAll();
    }

    /**
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
}