<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Billet;
use AppBundle\Entity\Comment;
use AppBundle\Form\BilletType;

class BilletController extends Controller
{
	/**
	* @Route("billet/new", name="billet_new")
	*/
	public function newAction(Request $request)
	{         
        $form = $this->createForm('AppBundle\Form\BilletType');
        $form->handleRequest($request);

        $billet = $form->getData();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = $user->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $billet->setUser_id($user_id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($billet);  
            $em->flush();

            $this->addFlash('success', 'Billet bien créé !');

            return $this->redirectToRoute('billet_show');
        }
        return $this->render('billet/new.html.twig', [
            'form' => $form->createView(),
        ]);
	}

	/**
	* @Route("/billet", name="billet_show")
	*/
	public function showAction(Request $request)
	{
		$listeBillets = $this->getDoctrine()
        ->getRepository(Billet::class)
        ->findAll();

        $comments = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findAll();
        $nbr_comments = 0;

        $billets = $this->get('knp_paginator')->paginate(
        $listeBillets,
        $request->query->get('page', 1), 6);

        return $this->render('billet/show.html.twig', [
            'billets' => $billets,
            'comments' => $comments,
            'nbr_comments' => $nbr_comments,
        ]);
	}

	/**
	* @Route("/billet/{id}/edit", name="billet_edit")
	*/
	public function editAction(Request $request, Billet $billet, $id)
	{
		if (isset($_SERVER['HTTP_REFERER'])) {
			if (parse_url($_SERVER['HTTP_REFERER'])['path'] != '/billet') {
				$this->addFlash('error', 'Vous ne pouvez pas modifier ce billet !');
				return $this->redirectToRoute('billet_show');
			}
		}
		$billet = $this->getDoctrine()
        ->getRepository(Billet::class)
        ->find($id);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($billet->getUser_id() != $user->getId()) {
			return $this->redirectToRoute('billet_show');
        }


		$form = $this->createForm(BilletType::class, $billet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Billet modifié !');

            return $this->redirectToRoute('billet_show');
        }
        return $this->render('billet/edit.html.twig', [
            'form' => $form->createView(),
        ]);
	}

	/**
    * @Route("/billet/{id}/delete", name="billet_delete")
    */
    public function deleteAction(Billet $billet, $id) {
    	if (isset($_SERVER['HTTP_REFERER'])) {
			if (parse_url($_SERVER['HTTP_REFERER'])['path'] != '/billet') {
				return $this->redirectToRoute('billet_show');
			}
		}
		$billet = $this->getDoctrine()
        ->getRepository(Billet::class)
        ->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($billet->getUser_id() != $user->getId()) {
        	$this->addFlash('error', 'Vous ne pouvez pas modifier ce billet !');
			return $this->redirectToRoute('billet_show');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($billet);
        $em->flush();

		$this->addFlash('success', 'Billet supprimé !');

        return $this->redirectToRoute('billet_show');
    }
}
