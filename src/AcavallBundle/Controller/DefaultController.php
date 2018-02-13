<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AcavallBundle\Entity\Event;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AcavallBundle:Event');
        $evento = $repository->findAll();

        return $this->render('default/index.html.twig',array("eventos"=>$evento));
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
        $repository = $this->getDoctrine()->getRepository('AcavallBundle:Event');
        $evento = $repository->findAll();

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

    public function emailAction($name)
{
    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('pruebaacavall@gmail.com')
        ->setTo('joravlo@gmail.com')
        ->setBody(
            $this->renderView(
                'default/email.html.twig',
                array('name' => $name)
            ),
            'text/html'
        )
    ;
    $this->get('mailer')->send($message);

    return $this->render('default/email.html.twig');
}

}
