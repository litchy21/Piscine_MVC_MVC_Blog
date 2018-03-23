<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Billet;
use AppBundle\Form\CommentType;

class CommentController extends Controller
{
	/**
    * @Route("/billet/{id}", name="comment_show")
    */
    public function showBilletAction(Request $request, $id)
    {
        $billet = $this->getDoctrine()
        ->getRepository(Billet::class)
        ->find($id);

        $form = $this->createForm('AppBundle\Form\CommentType');
        $form->handleRequest($request);

        $comment = $form->getData();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = $user->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser_id($user_id);
            $comment->setBillet_id($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);  
            $em->flush();

            $this->addFlash('success', 'Commentaire envoyé !');
        }

        $comments = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findBy(array('billet_id' => $id));

        return $this->render('comment/show.html.twig', [
            'billet' => $billet,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }
}














