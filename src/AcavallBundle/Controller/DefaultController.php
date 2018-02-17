<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AcavallBundle\Entity\Event;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AcavallBundle:Event');
        $evento = $repository->getAllEvents();

        return $this->render('default/index.html.twig',array("eventos"=>$evento));
    }

    public function passwordAction()
    {
        return $this->render('default/password.html.twig');
    }

    public function gestorAction(Request $request)
    {
        /*$repository = $this->getDoctrine()->getRepository('AcavallBundle:Event');
        $evento = $repository->findAll();*/

        $em = $this->getDoctrine()->getManager();

        $listeEvents = $em->getRepository('AcavallBundle:Event')->findAll();
        $evento = $this->get('knp_paginator')->paginate(
          $listeEvents,
          $request->query->get('page', 1), 10);

        return $this->render('default/gestorEvent.html.twig',array("eventos"=>$evento));
    }

    public function eventAction($eventId)
    {
      $em = $this->getDoctrine()->getManager();
      $event = $em->getRepository(Event::Class)->find($eventId);

      $eventsCategory = $em->getRepository(Event::Class)->getEvetsByCategory($event->getCategories()[0]->getId());

        return $this->render('default/event.html.twig',array('event'=>$event,'eventsCategory'=>$eventsCategory));
    }

    public function buyAction()
    {
        return $this->render('default/ticket.html.twig');
    }

    public function ticketAction()
    {
        return $this->render('default/entrada.html.twig');
    }

    public function emailRegisterAction($id, $name)
    {

      $repository = $this->getDoctrine()->getRepository('AcavallBundle:User');
      $usuarios = $repository->findOneById($id);



      $message = (new \Swift_Message('Email de Registro'))

          ->setFrom('pruebaacavall@gmail.com')
          ->setTo('joravlo@gmail.com')
          ->setBody(
              $this->renderView(
                  'default/emailregistro.html.twig',
                  array('name' => $name,
                        "usuario"=>$usuarios)
              ),
              'text/html'
          )
      ;
      $this->get('mailer')->send($message);

      return $this->render('default/emailregistro.html.twig',array("usuario"=>$usuarios));
    }

    public function emailTicketAction($name)
    {
    $message = (new \Swift_Message('Email de Registro'))

        ->setFrom('pruebaacavall@gmail.com')
        ->setTo('joravlo@gmail.com')
        ->setBody(
            $this->renderView(
                'default/emailTicket.html.twig',
                array('name' => $name)
            ),
            'text/html'
        )

    ;
    $this->get('mailer')->send($message);

    return $this->render('default/email.html.twig');
    }
}
