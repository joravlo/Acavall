<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    public function loginAction()
    {
        return $this->render('default/login.html.twig');
    }

    public function recordarAction()
    {
        return $this->render('default/recordarcontrasena.html.twig');
    }
}
