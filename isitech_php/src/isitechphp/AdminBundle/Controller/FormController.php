<?php
namespace isitechphp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Acme\TaskBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    public function newAction(Request $request)
    {
        // crée une tâche et lui donne quelques données par défaut pour cet exemple
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit')
            ->getForm();

        return $this->render('isitechphpAdminBundle:form:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}