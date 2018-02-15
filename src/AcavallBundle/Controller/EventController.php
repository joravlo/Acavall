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
        //Get image to fileType
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $imageFile = $event->getImage();

        //Generated a unique name for the image
        $imageFileName = md5(uniqid()).'.'.$imageFile->guessExtension();
        // Move the file to the directory where brochures are stored
        $imageFile->move(
           $this->getParameter('image_event_directory'),
           $imageFileName
       );

        $event->setImage($imageFileName);
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
    $urlFoto = $event->getImage();
    $event->setImage(null);
    $form = $this->createForm(EventType::class, $event);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $event = $form->getData();
        if ($event->getImage() == null) {
          $event->setImage($urlFoto);
        } else {
          //Get image to fileType
          /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
          $imageFile = $event->getImage();

          //Generated a unique name for the image
          $imageFileName = md5(uniqid()).'.'.$imageFile->guessExtension();
          // Move the file to the directory where brochures are stored
          $imageFile->move(
             $this->getParameter('image_event_directory'),
             $imageFileName
         );

          $event->setImage($imageFileName);
        }

        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('acavall_manage');
      }
      return $this->render('default/updateEvent.html.twig',array('form'=>$form->createView(),"event"=>$event,"urlFoto"=>$urlFoto));
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
