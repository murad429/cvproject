<?php


namespace App\Controller;
use App\Entity\Video;
use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    /**
     * @Route("/user/admin", name="admincontroller")

     */
public function newAction(Request $request){
    $vedio = new Video();
    $form=$this->createFormBuilder($vedio)
        ->add('id',TextType::class)
        ->add('title',PasswordType::class)
        ->add('description',TextareaType::class)
        ->add('url',UrlType::class)
        ->add('insert', SubmitType::class, array('label' => 'Insert'))
        ->getForm();

    return $this->render('admin.html.twig', array(
        'form' => $form->createView(),
    ));
}
}