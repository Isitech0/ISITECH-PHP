<?php
/**
 * Created by PhpStorm.
 * User: JPrévost
 * Date: 30/06/2015
 * Time: 15:32
 */

namespace isitechphp\MainBundle\Controller;

use AppBundle\Entity\Utilisateur;
//use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CheckLogin extends Controller
{


    /**
     * Example check_login
     * @Route("/check_login")
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
                /*
                session_destroy();
                session_start ();
                */


                $session = new Session();
                $session->invalidate();
                $session->start();

                $session->set('user', $advert);
                $test = 'identification correct';


                //echo $azaz;
                return $this->render('isitechphpMainBundle:Default:index.html.twig');
            }
            else
            {
                echo "Le mot de passe est incorecte";
                return $this->render('isitechphpMainBundle:Default:login.html.twig');
            }
        }

        }


    /**
     * Example login
     * @Route("/login", name="login")
     * @return Response
     */
    public function login()
    {
        return $this->render('isitechphpMainBundle:Default:login.html.twig');
    }


    /**
 * Example checklogin
 * @Route("/checklogin")
 * @return Response
 */
    public function checklogin()
    {
        return $this->render('isitechphpMainBundle:Default:CheckLogin.php');
    }

    /**
     * Example register
     * @Route("/register", name="register")
     * @return Response
     */
    public function register()
    {
        return $this->render('isitechphpMainBundle:Default:register.html.twig');
    }

    /**
     * Example register_db
     * @Route("/register_db", name="registerdb")
     * @return Response
     */
    public function register_db()
    {
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
            echo "L'utilisateur existe deja!";

            return $this->render('isitechphpMainBundle:Default:register.html.twig');
        }
        //        $dt = new DateTime();
        //       $newuser->setDescription('Test User' + $dt->format('Y-m-d H:i:s'));

        // Récupération de l'instance ORM
        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur
        $em->persist($newUser);
        $em->flush();

        echo "L'utilisateur a bien été créé.";
        return $this->render('isitechphpMainBundle:Default:login.html.twig');
    }

    }