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
    public function newAction(Request $request, $id = null)
    {
        $id = $id ? $id : 'MyBundle:ControllerName:index.html.twig';

        $task = new Form();
        $task->setForm('foobar');
        $task->setIdUser($id);

        $form = $this->createFormBuilder($task)
            ->add('idUser','text')
            ->add('Delete', 'submit')
            ->getForm();

        return $this->render('isitechphpAdminBundle:form:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
//->add('idUser', 'hidden', array('data' => 'recuperer id depuis ligne')
