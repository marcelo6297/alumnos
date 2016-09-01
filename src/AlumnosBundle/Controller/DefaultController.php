<?php

namespace AlumnosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlumnosBundle:Default:index.html.twig');
    }
}
