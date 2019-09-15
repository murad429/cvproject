<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    /**
     * @Route("/user/logout")
     */
public function logoutAction(Request $request){
   $session = $request->getSession();
   $session->invalidate();

    return $this->redirectToRoute("logincontroller") ;
}
}