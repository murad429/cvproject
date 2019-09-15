<?php


namespace App\Controller;

use App\Entity\Video;
use Mission_locale\AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
  *@Route("/user/user",name="usercontrol")
     */
public function searchAction(Request $request){
    $video = new Video();
    $form = $this->createFormBuilder()
     ->add('search', TextType::class)
        ->add('submit', SubmitType::class, array('label' => 'Search'))
        ->getForm();
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid() && $form->getClickedButton() ) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
                FROM App:Video p
                WHERE p.title like :title
                ORDER BY p.title ASC'
        )->setParameter('title', '%' . $request->get('form')["search"] . '%');
        $movies = $query->getResult();
        return $this->render('user.html.twig',array(
            'form'=>$form->createView(),
            'movies'=>$movies,

        ));
    }else {
        return $this->render('user.html.twig', array(
            'form' => $form->createView(),
            'movies' =>[],

        ));

    }
}

}