<?php

namespace Site\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class Logged extends Controller
{
    public function foo(){
        return new Response('Hello world!');
    }
    public function listing(){
        //retourne une liste de produits
        //appelle constructeur produit
    }
    public function ordered(){
        
    }
}