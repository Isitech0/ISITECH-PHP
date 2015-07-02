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
     * @Route("/admin/form", name="new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $task = new Form();
        $task->setForm('foobar');

        $form = $this->createFormBuilder($task)
            ->add('Delete', 'submit')
            ->getForm();

        return $this->render('isitechphpAdminBundle:form:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

