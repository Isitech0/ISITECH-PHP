<?php

namespace Sample\AdminBundle\Controller;

//use Symfony\Component\Validator\Constraints\DateTime;
//use Sample\AdminBundle\Entity\Utilisateur;
use AppBundle\Entity\Droit;
use AppBundle\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * Example Create Users
     * @Route("/postUser")
     * @return Response
     */
    public function createUser()
    {
        $newuser = new Utilisateur();
        $newuser->setNom('Alexis');
        $newuser->setPrenom('landrieu');
        $newuser->setPassword(hash('sha256', 'azertyuiop'));
        $newuser->setMail('toto@toto.com');

        $newdroit = new Droit();

        $newdroit->setId(1);
        $newdroit->setNom("admin");
        $newdroit->setPriorite(0);

        $newuser->setDroit($newdroit);


        //        $dt = new DateTime();
        //       $newuser->setDescription('Test User' + $dt->format('Y-m-d H:i:s'));

        // Récupération de l'instance ORM
        $em = $this->getDoctrine()->getManager();

        // Enregistrement de l'utilisateur

        $em->persist($newuser);
        $em->persist($newdroit);
        $em->flush();

        return new Response('Id du utilisateur créé : '.$newuser->getId());
    }

    /**
     * Example Select ALL Users
     * @Route("/getUser")
     * @return Response
     */
    public function selectUser()
    {
        //        $newuser = $this->getDoctrine()
        //            ->getRepository('AcmeStoreBundle:Product')
        //            ->find($id);
        //
        //        if (!$product) {
        //            throw $this->createNotFoundException(
        //                'Aucun Utilisateur trouvé pour cet id : '.$id
        //            );
        //        }

        $repository = $this->getDoctrine()
            ->getRepository('SampleAdminBundle:Utilisateur');

        // ... faire quelque chose comme envoyer l'objet $product à un template
        // requête par clé primaire (souvent "id")
        //      $product = $repository->find($id);

        // Noms de méthodes dynamiques en se basant sur un nom de colonne
        //        $product = $repository->findOneById($id);
        //$product = $repository->findOneByName('foo');

        // trouver *tous* les produits
        $newuser = $repository->findAll();

        // trouver un groupe de produits en se basant sur une valeur de colonne
        //        $products = $repository->findByPrice(19.99);
//
//        $indexedOnly = array();
//
//        foreach ($newuser as $row) {
//            $indexedOnly[] = array_values($row);
//        }
//
//        //json_encode($indexedOnly);

        return new Response(json_encode(array_values($newuser)));
    }

    /**
     * Example Update Users
     * @Route("/putUser/{id}")
     * @return Response
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $newuser = $em->getRepository('SampleAdminBundle:Utilisateur')->find($id);

        if (!$newuser) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé pour cet id : '.$id
            );
        }

        $newuser->setName('Nom du nouveau Utilisateur!');
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * Example Drop Users
     * @Route("/dropUser/{id}")
     * @return Response
     */
    public function dropAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $newuser = $em->getRepository('SampleAdminBundle:Utilisateur')->find($id);

        if (!$newuser) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé pour cet id : '.$id
            );
        }

        $em->remove($newuser);
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }
}
