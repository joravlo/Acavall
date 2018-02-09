<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AcavallBundle\Entity\Event;

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

    public function eventAction($eventId)
    {
      $em = $this->getDoctrine()->getManager();
      $event = $em->getRepository(Event::Class)->find($eventId);

      $eventsCategory = $em->getRepository(Event::Class)->getEvetsByCategory($event->getCategories()[0]->getId());

        return $this->render('default/event.html.twig',array('event'=>$event,'eventsCategory'=>$eventsCategory));
    }

    public function ticketAction()
    {
        return $this->render('default/ticket.html.twig');
    }

}
