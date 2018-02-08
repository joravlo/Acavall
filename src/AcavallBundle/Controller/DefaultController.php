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

    public function passwordAction()
    {
        return $this->render('default/password.html.twig');
    }

    public function manageAction()
    {
        return $this->render('default/gestorEvent.html.twig');
    }

    public function eventAction()
    {
        return $this->render('default/event.html.twig');
    }

    public function buyAction()
    {
        return $this->render('default/ticket.html.twig');
    }

    public function ticketAction()
    {
        return $this->render('default/entrada.html.twig');
    }

}
