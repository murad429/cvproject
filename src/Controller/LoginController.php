<?php


namespace App\Controller;


use App\Entity\LoginForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends AbstractController {
    /**
     * @Route("/user/login", name="logincontroller")

     */
public function newAction(Request $request){
    $usr=new LoginForm();
    $form=$this->createFormBuilder($usr)
        ->add('userName',TextType::class)
        ->add('password',PasswordType::class)
        ->add('save', SubmitType::class, array('label' => 'Submit'))
        ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $login_data =$form->getData();
        if($login_data->getUserName()=='Murad' && $login_data->getPassword()=='123'){
            return new Response("User photo is successfully uploaded.");
        }elseif($login_data->getUserName()=='Admin' && $login_data->getPassword()=='786'){
            return $this->redirectToRoute("admincontroller");
        }else{
            return $this->render('login.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

         return $this->render('login.html.twig', array(
             'form' => $form->createView(),
         ));
}
}