<?php

namespace AcavallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AcavallBundle\Entity\User;
use AcavallBundle\Form\UserType;

class RegisterController extends Controller
{

  public function registerAction(Request $request)
  {

      $user  = new User();
      $form = $this->createForm(UserType::class, $user);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

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
        $message = (new \Swift_Message('Email de Registro'))

            ->setFrom('pruebaacavall@gmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'default/emailregistro.html.twig',
                    array('name' => $user->getName(),
                          'usuario' => $user)
                ),
                'text/html'
            )
        ;
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('acavall_homepage');
      }

      return $this->render(
          'default/login.html.twig',
          array('form' => $form->createView())
      );
  }


  public function loginAction(Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');

    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('default/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
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
