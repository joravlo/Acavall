<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use AcavallBundle\Entity\Event;
use AcavallBundle\Entity\Category;

class ApiController extends Controller
{

  public function deleteEventAction($eventId)
  {
    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository(Event::Class)->find($eventId);

    $encoders = array(new JsonEncoder());
    $normalizers = array(new ObjectNormalizer());
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($event)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe el evento"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $em->remove($event);
      $em->flush();
      $jsonContent = $serializer->serialize(array('code' => 200,'message' => "Eliminado con exito"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventsWithCategoryAction($categoryId)
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->getEvetsByCategory($categoryId);

    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceLimit(1);
    // Add Circular reference handler
    $normalizer->setCircularReferenceHandler(function ($object) {
        return $object->getId();
    });
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existen eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventAction($eventId)
  {
    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository(Event::Class)->find($eventId);
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($event)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe el evento"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($event, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getAllEventsAction()
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->findAll();
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventsTodayAction()
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->getEvetsToday();
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventsTomorrowAction()
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->getEvetsTomorrow();
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventsThisWeekAction()
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->getEventsThisWeek();
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventsThisWeekendAction()
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->getEventsThisWeekend();
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function getEventsThisMonthAction()
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em->getRepository(Event::Class)->getEventsThisMonth();
    $encoders = array(new JsonEncoder());
    $normalizer = new ObjectNormalizer();
    $normalizer->setCircularReferenceHandler(function ($object) {
    return $object->getName();
});
    $normalizer->setIgnoredAttributes(array('tags', 'laundry'));
    $normalizers = array($normalizer);
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($events)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe eventos"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $jsonContent = $serializer->serialize($events, 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }

  public function publicarEventAction($eventId)
  {
    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository(Event::Class)->find($eventId);

    $encoders = array(new JsonEncoder());
    $normalizers = array(new ObjectNormalizer());
    $serializer = new Serializer($normalizers, $encoders);

    if (empty($event)) {
      $jsonContent = $serializer->serialize(array('code' => 400,'message' => "No existe el evento"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    } else {
      $publ = $event->getPublish();
      if($publ == false){$event->setPublish(true);}else{$event->setPublish(false);}
      $em->persist($event);
      $em->flush();
      $jsonContent = $serializer->serialize(array('code' => 200,'message' => "Publicado con exito"), 'json');
      $response = JsonResponse::fromJsonString($jsonContent);
    }

      return $response;
  }
}
