<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AcavallBundle\Entity\Event;
use AcavallBundle\Form\EventType;

class EventController extends Controller
{
  public function createEventAction(Request $request)
  {
    $event = new Event();
    $form = $this->createForm(EventType::class, $event);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $event = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('acavall_manage');
      }
      return $this->render('default/createEvent.html.twig',array('form'=>$form->createView()));
  }

  public function updateEventAction(Request $request, $eventId)
  {
    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository(Event::Class)->find($eventId);
    $form = $this->createForm(EventType::class, $event);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $event = $form->getData();
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('acavall_manage');
      }
      return $this->render('default/createEvent.html.twig',array('form'=>$form->createView()));
  }

  public function deleteEventAction($eventId)
  {
    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository(Event::Class)->find($eventId);
    $em->remove($event);
    $em->flush();

    return $this->redirectToRoute('acavall_manage');
  }


}
