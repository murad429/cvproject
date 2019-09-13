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
public function newAction(Request $request)
{
    $video = new Video();

    $form = $this->createFormBuilder($video)
        ->add('title', TextType::class)
        ->add('description', TextareaType::class)
        ->add('url', UrlType::class)
        ->add('insert', SubmitType::class, array('label' => 'Insert'))
        ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid() && $form->getClickedButton() ) {
        $video_data = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Video::class);
        $em->persist($video_data);
        $movies = $repository->findAll();
        $em->flush();
        return $this->redirectToRoute("admincontroller",array(
            'form' => $form->createView(),
            'movies' => $movies,
        ));
    }
    else {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Video::class);
        $movies = $repository->findAll();
        return $this->render('admin.html.twig', array(
            'form' => $form->createView(),
            'movies' => $movies,
        ));
    }
}
}