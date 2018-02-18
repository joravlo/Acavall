<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AcavallBundle\Entity\Event;
use AcavallBundle\Entity\Ticket;
use AcavallBundle\Form\TicketType;

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

      if ($event->getCategories() != null) {
        $eventsCategory = $em->getRepository(Event::Class)->getEvetsByCategory($event->getCategories()[0]->getId());
        return $this->render('default/event.html.twig',array('event'=>$event,'eventsCategory'=>$eventsCategory));
      } else {
        return $this->render('default/event.html.twig',array('event'=>$event));
      }
    }

    public function buyAction(Request $request, $id, $iduser)
    {

        if ($iduser == "notUser") {
          return $this->redirectToRoute('acavall_register');
        } else {
          $repository = $this->getDoctrine()->getRepository('AcavallBundle:Event');
          $event = $repository->findOneById($id);
          $repositoryuser = $this->getDoctrine()->getRepository('AcavallBundle:User');
          $user = $repositoryuser->findOneById($iduser);

          $ticket = new Ticket();
          $form=$this->createForm(TicketType::class, $ticket);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
            $ticket=$form->getData();
            $todayDate = new \DateTime("now");
            if ($ticket->getGender() == "adulto") {
              $ticket->setChildage(null);
            }
            $ticket->setDate($todayDate);
            $ticket->setPrice($event->getPrice());
            $ticket->setPersonalDocument($user->getPersonalDocument());
            $ticket->setTransactionData("asdafsdf");
            $ticket->setUser($user);
            $ticket->setEvent($event);
            $ticket->setNumTicket($event->getActualCapacity());
            $event->setActualCapacity($event->getActualCapacity()-1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->persist($event);
            $em->flush();
            $message = (new \Swift_Message('Entrada '.$event->getName()))

                ->setFrom('pruebaacavall@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'default/emailEntrada.html.twig',
                        array('event' => $event,
                              "user"=>$user,
                              'ticket'=>$ticket)
                    ),
                    'text/html'
                )
            ;
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('acavall_ticket', array('eventId'=>$event->getId(),'userId'=>$user->getId(),'ticketId'=>$ticket->getId())));
         }

          return $this-> render('default/ticket.html.twig', array('form'=>$form->createView(),"event"=>$event));
        }
    }

    public function ticketAction($eventId,$userId,$ticketId)
    {
      $repository = $this->getDoctrine()->getRepository('AcavallBundle:Event');
      $event = $repository->findOneById($eventId);
      $repositoryuser = $this->getDoctrine()->getRepository('AcavallBundle:User');
      $user = $repositoryuser->findOneById($userId);
      $repositoryTicket = $this->getDoctrine()->getRepository('AcavallBundle:Ticket');
      $ticket = $repositoryTicket->findOneById($ticketId);

        return $this->render('default/entrada.html.twig',array("event"=>$event,"user"=>$user,"ticket"=>$ticket));
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
