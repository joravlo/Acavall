<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AcavallBundle\Entity\User;
use AcavallBundle\Form\UserType;

class RegisterController extends Controller
{

  public function loginAction(Request $request)
  {
      // build the form
      $user  = new User();
      $form1 = $this->createForm(UserType::class, $user);
      $form2 = $this->createForm(UserType::class, $user);

      if ($request->isMethod('POST')) {

        // handle the submit (will only happen on POST)
        $form1->handleRequest($request);
        $form2->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()) {

          // Encode the password (you could also do this via Doctrine listener)
          $password = $this->get('security.password_encoder')
              ->encodePassword($user, $user->getPlainPassword());
          $user->setPassword($password);

          $role = ['ROLE_USER'];
          $user->setRoles($role);

          $random = random_bytes(10);
          $user->setVerifyCode(bin2hex($random));

          $user->setVerifyPassword(false);

          // save the User
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();

          // return $this->redirectToRoute('replace_with_some_route');

        } else if ($form2->isSubmitted()) {
          $authenticationUtils = $this->get('security.authentication_utils');
        }
      }

      return array(
       'form1' => $form1->createView(),
       'form2' => $form2->createView()
      );

      /*return $this->render(
          'default/login.html.twig',
          array('form' => $form->createView())
      );*/
  }

  public function urlcodeAction($ramCode)
  {

    $repository = $this->getDoctrine()->getRepository('AcavallBundle:User');
    $userInput = $repository->findOneByVerifyCode($ramCode);

    if (empty($userInput)) {
      return $this->redirectToRoute('acavall_code',array("boolCode"=>false));
    }else{

      $userInput->setVerifyPassword(true);
      $em = $this->getDoctrine()->getManager();
      $em->persist($userInput);
      $em->flush();

      return $this->redirectToRoute('acavall_code',array("boolCode"=>true));
    }
  }

}
