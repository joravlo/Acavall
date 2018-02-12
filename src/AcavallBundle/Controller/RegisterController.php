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
      // build the form
      $user = new User();
      $form = $this->createForm(UserType::class, $user);

      // handle the submit (will only happen on POST)
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

        // save the User
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // return $this->redirectToRoute('replace_with_some_route');
      }

      return $this->render(
          'default/register.html.twig',
          array('form' => $form->createView())
      );
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
