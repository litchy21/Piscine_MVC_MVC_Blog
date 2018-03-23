<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\User;
use AppBundle\Form\UserFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserAdminController extends Controller
{
    /**
    * @Route("/admin", name="admin_index")
    */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();
        return $this->render('admin/user/index.html.twig', array(
            'users' => $users
        ));
    }
}