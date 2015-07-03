<?php

namespace isitechphp\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\AlertBootStrap;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UtilisateursController extends Controller
{

    public function selectUtilisateur()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        return $repository->findAll();
    }

    //Renvoie sur la page pour afficher ses informations.
    /**
     * Example user_information
     * @Route("/user_information", name="userinformation")
     * @return Response
     */
    public function user_information()
    {
        return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig');
    }

    //Permet de changer ses informations comme le nom,prenom et mot de passe, je vérrifie que l'ancien mot de passe
    //correspond bien et que le nouveau correspond quand il est confirmé.
    /**
     * Example user_change
     * @Route("/user_change", name="userchange")
     * @return Response
     */
    public function user_change()
    {
        $session = new Session();
        $user = $session->get('user');
        $utlisateur = new Utilisateur();
        $em = $this->getDoctrine()->getManager();
        $utlisateur = $em->getRepository('AppBundle:Utilisateur')->find($user->getId());

        if(trim($_POST['old_password']) != Null)
        {
            $old_password = trim (hash('sha256', trim($_POST['old_password'])));

            if($old_password != $session->get('user')->getPassword())
            {
                $newnote = new AlertBootStrap();
                $newnote->setMessage("L'ancien mot de passe n'est pas correct!");
                $newnote->setType("warning");
                return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig', array('note' => $newnote));
            }

            if($old_password == $session->get('user')->getPassword())
            {
                if(trim($_POST['new_password']) == Null)
                {
                    $newnote = new AlertBootStrap();
                    $newnote->setMessage("Le nouveau mdp na pas ete renseigner!");
                    $newnote->setType("warning");
                    return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig', array('note' => $newnote));
                }
                if(trim($_POST['confirm_password']) == Null)
                {
                    $newnote = new AlertBootStrap();
                    $newnote->setMessage("Le nouveau mdp na pas ete confirmer!");
                    $newnote->setType("warning");
                    return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig', array('note' => $newnote));
                }

                if(trim($_POST['new_password']) == trim($_POST['confirm_password']))
                {
                    $utlisateur->setPassword(trim (hash('sha256', trim($_POST['confirm_password']))));
                    $user->setPassword($utlisateur->GetPassword());
                }
            }

        }

        if(trim($_POST['old_password']) != Null OR trim($_POST['new_password']) != Null OR trim($_POST['confirm_password']) != Null)
        {
            if(trim($_POST['old_password']) == Null OR trim($_POST['new_password']) == Null OR trim($_POST['confirm_password']) == Null)
            {
                $newnote = new AlertBootStrap();
                $newnote->setMessage("Tous les champs doivent etre remplies pour changer le mot de passe!");
                $newnote->setType("warning");
                return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig', array('note' => $newnote));
            }
        }


        $utlisateur->setNom(trim($_POST['nom']));
        $utlisateur->setPrenom(trim($_POST['prenom']));

        $em->flush();

        $user->setNom($utlisateur->GetNom());
        $user->setPrenom($utlisateur->GetPrenom());


        $newnote = new AlertBootStrap();
        $newnote->setMessage("L'utilisateur a été modifié");
        $newnote->setType("success");

        return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig', array('note' => $newnote));
    }

}
