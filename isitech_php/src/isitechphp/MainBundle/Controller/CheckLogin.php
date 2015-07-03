<?php
/**
 * Created by PhpStorm.
 * User: JPrévost
 * Date: 30/06/2015
 * Time: 15:32
 */

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Droit;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\AlertBootStrap;
//use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CheckLogin extends Controller
{

//La fonction recupére le mail et le mot de passe envoyés par le formulaire dans la page login.html.twig,
//premièrement je vérifie que le mail est bien présent dans la bdd, si il existe je récupère l'entrée correspondante
//puis je compare le mot de passe transmit par le firmulaire avec celui récupéré dans la bdd.
    /**
     * Example check_login
     * @Route("/check_login", name="checkuserlogin")
     * @return Response
     */
    public function check_login()
    {


        $mail = trim($_POST['mail']);
        $password = trim(hash('sha256', trim($_POST['password'])));
        //$newuser->setPassword(hash('sha256', trim($_POST['password'])));


        //return true;

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');

        $advert = $repository->findOneBy(array('mail' => $mail));

        if($advert == Null)
        {
            echo "Utilisateur inexistant";
            return $this->render('isitechphpMainBundle:Default:login.html.twig');
        }

        if($advert != Null)
        {
            $current_mail =  $advert->getMail();

            $current_password = $advert->getpassword();
            if($mail == $current_mail  AND $password == $current_password)
            {

                $repository = $this->getDoctrine()
                    ->getRepository('AppBundle:Droit');

                $droit = $repository->findOneBy(array('id' => $advert->getDroit()));
                $advert->setDroit($droit);
                //echo $advert->getDroit().nom;

                $session = new Session();
                //$session->invalidate();
                //$session->start();


                $session->set('user', $advert);
                $test = 'identification correct';

                //$info = new Info();
                //$this->container->get('request')->getSession()->set('info', $advert);

                //echo $azaz;
                //return $this->render('isitechphpMainBundle:Default:index.html.twig');
                return $this->redirect($this->generateUrl('homepagev2'));
            }
            else
            {
                $newnote = new AlertBootStrap();
                $newnote->setMessage("Le mot de passe est incorrecte");
                $newnote->setType("warning");
                return $this->render('isitechphpMainBundle:Default:login.html.twig', array('note' => $newnote));
            }
        }

        }

//Permet d'afficher la page login.html.twig, pour pouvoir se connecter.
    /**
     * Example login
     * @Route("/login", name="login")
     * @return Response
     */
    public function login()
    {
        return $this->render('isitechphpMainBundle:Default:login.html.twig');
    }

//Permet d'afficher la page register.html.twig, pour pouvouir créer un nouvel utilisateur.
    /**
     * Example register
     * @Route("/register", name="register")
     * @return Response
     */
    public function register()
    {
        return $this->render('isitechphpMainBundle:Default:register.html.twig');
    }

//Fonction appelée quand le formulaire de création d'un utilisateur est soumis, premièrement je recupère les
//valeurs puis je vérifie dans la base que l'adresse mail n'existe pas deja, si elle n'existe pas je créé l'utilisateur
//dans la bdd
    /**
     * Example register_db
     * @Route("/register_db", name="registerdb")
     * @return Response
     */
    public function register_db()
    {
        $newnote = new AlertBootStrap();


        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Droit');
        $advert = $repository->findOneBy(array('id' => '2'));

        $newUser = new Utilisateur();
        $newUser->setNom(trim($_POST['lastname']));
        $newUser->setPassword(trim (hash('sha256', trim($_POST['password']))));
        $newUser->setPrenom(trim($_POST['firstname']));
        $newUser->setMail(trim($_POST['email']));
        $newUser->setDroit($advert);

        $currentMail = $_POST['email'];
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur');
        $compareMail = $repository->findOneBy(array('mail' => $currentMail));

        if ($compareMail != Null)
        {

            $newnote->setMessage("L'utilisateur existe deja!");
            $newnote->setType("warning");

            return $this->render('isitechphpMainBundle:Default:register.html.twig', array('note' => $newnote));
        }

        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newUser);
        $em->flush();

        $newnote->setMessage("L'utilisateur a bien été créé");
        $newnote->setType("success");

        return $this->render('isitechphpMainBundle:Default:login.html.twig', array('note' => $newnote));
    }

    /**
     * Example logout
     * @Route("/logout", name="logout")
     * @return Response
     */
    public function logout()
    {
        $session = new Session();
        $session->invalidate();
        //return $this->render('isitechphpMainBundle:Default:login.html.twig');
        return $this->redirect($this->generateUrl('login'));
    }

    }