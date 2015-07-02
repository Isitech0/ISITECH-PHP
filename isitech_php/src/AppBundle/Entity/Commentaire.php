<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string",length=255)
     */
    private $date;

    // permet de faire le lien avec l entity utilisateur un commentaire appartient a un seul utilisateur
    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    // permet de faire le lien avec l entity article un commentaire correspond a un seul article
    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;


    // instancie un utilisateur et un article
    public function __construct(){
        $this->user = new Utilisateur();
        $this->article =new Article();
    }




    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Commentaire
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set setUser
     *
     * @param integer $user
     * @return Utilisateur
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set setArticle
     *
     * @param integer $article
     * @return Utilisateur
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return integer
     */
    public function getArticle()
    {
        return $this->article;
    }
}
