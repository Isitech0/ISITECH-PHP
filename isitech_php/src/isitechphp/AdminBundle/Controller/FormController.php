<?php
namespace isitechphp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use isitechphp\AdminBundle\Entity\Form;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FormController extends Controller
{
    /**
     * @Route("/admin/form/{id}", name="supprimerutilisateur")
     * @Template()
     */
    public function newAction(Request $request, $idUser = null)
    {
//        $id = $id ? $id : 'MyBundle:ControllerName:index.html.twig';

        $task = new Form();
        $task->setForm('foobar');
        $task->setIdUser($idUser);

        $form = $this->createFormBuilder($task)
            ->add('idUser','hidden')
            ->add('Supprimer', 'submit')
            ->getForm();

        //soumission
        $form->handleRequest($request);

        if ($form->isValid()) {
            return $this->redirect($this->generateUrl('removeuser', array('idUser' => $idUser)));
        }

        return $this->render('isitechphpAdminBundle:form:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
