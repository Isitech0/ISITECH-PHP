<?php

namespace isitechphp\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Utilisateur;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UtilisateursController extends Controller
{
    /**
     * @Route("/hellov4")
     * @Template()
     */
    public function indexAction()
    {

//        $unutilisateur= new Utilisateur();
//
//        $unutilisateur->setNom("Leydier");
//        $unutilisateur->setPrenom("Josselin");
//        $unutilisateur->setMail("josselin.leydier@gmail.com");
//        $unutilisateur->setPassword("josselin123");
//
//        $listeUtilisateur = new ArrayCollection();
//        $listeUtilisateur->add($unutilisateur);


        return $this->render('isitechphpMainBundle:Default:Utilisateurs.html.twig', array('utilisateurs' => $this->selectUtilisateur()));
    }
    public function selectUtilisateur()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        return $repository->findAll();
    }

    /**
     * Example user_information
     * @Route("/user_information", name="userinformation")
     * @return Response
     */
    public function user_information()
    {
        return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig');
    }

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
                echo 'ko!!';
                return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig');
            }

            if($old_password == $session->get('user')->getPassword())
            {
                if(trim($_POST['new_password']) == Null)
                {
                    echo "Le nouveau mdp na pas ete renseigner!";
                    return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig');
                }
                if(trim($_POST['confirm_password']) == Null)
                {
                    echo "Le nouveau mdp na pas ete confirmer!";
                    return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig');
                }

                if(trim($_POST['new_password']) == trim($_POST['confirm_password']))
                {
                    echo "les mdp sont identiques!";
                    $utlisateur->setPassword(trim (hash('sha256', trim($_POST['confirm_password']))));
                    $user->setPassword($utlisateur->GetPassword());
                }
            }

        }

        //$session = new Session();


        $utlisateur->setNom(trim($_POST['nom']));
        $utlisateur->setPrenom(trim($_POST['prenom']));

        $em->flush();

        $user->setNom($utlisateur->GetNom());
        $user->setPrenom($utlisateur->GetPrenom());

        ?>
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Succès!</strong> L'utilisateur a été modifié.
        </div>
        <?php

        return $this->render('isitechphpMainBundle:Default:UserInformation.html.twig');
    }

}
