<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class BilletController extends Controller
{
	/**
	* @Route("billet/new", name="billet_new")
	*/
	public function newAction(Request $request)
	{
       	// $billet = new Billet();
        
        $form = $this->createForm('AppBundle\Form\BilletType');
        $form->handleRequest($request);

        $billet = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
        	$current_date = 'aujourd\'hui';
            $billet->setCreated($current_date);
            $billet->setUpdated($current_date);
            $user = new User();
            var_dump($user->getId());
            
            //$billet->setUser_id($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();

            $this->addFlash('success', 'Billet bien créé !');

            // return $this->redirectToRoute('/billet/new');
        }
        return $this->render('billet/new.html.twig', [
            // 'billet' => $billet,
            'form' => $form->createView(),
        ]);
	}
}














