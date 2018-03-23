<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
	/**
	* @Route("/inscription", name="user_register")
	*/
	public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
	{
		$form = $this->createForm('AppBundle\Form\UserType');
		$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$user = $form->getData();

        	$password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bonjour vous etes bien inscrit ! Connectez-vous !');
            return $this->redirectToRoute('security_login');
        }
       	return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
	}

	/**
	* @Route("/profil", name="user_profil")
	*/
	public function showAction(){
		return $this->render('user/show.html.twig');
	}
}














