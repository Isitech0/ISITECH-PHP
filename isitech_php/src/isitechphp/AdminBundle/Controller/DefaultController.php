<?php

namespace isitechphp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    public function removeUser($id){
        //appeller fonction remove user dans le entiée User
    }

    public function setRight($id){
        //pareilavec fonction danscontroller User
    }

}
