<?php


namespace App\Controller;


use App\Entity\Video;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class EditController extends AbstractController {
    /**
     * @Route("/user/edit/", name="edit" )
     */
    public function editAction(Request $request){
        $video = new Video();
      // $string = $request->get('title')+" "+$request->get('description')+" "+$request->get('url') ;
        $id =$request->get('form')['id'];
        $title=$request->get('form')['title'];
        $description=$request->get('form')['description'];
        $url=$request->get('form')['url'];
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Video::class);

       return new Response("response"+$id+" "+$title+" "+$description+" "+$url);

      // return  this->redirectToRoute("admincontroller");

        }

    /**
     * @Route("/user/edit/{id}", name="editcontroller")
     */
    public function displayAction( Request $request,$id)
    {
        $video = new Video();

        $form = $this->createFormBuilder()
            ->add('id', TextType::class, array(
                'attr' => ['readonly' => true],
            ))
            ->add('title', TextType::class, array(
                'attr' => ['readonly' => true],
            ))
            ->add('description', TextareaType::class)
            ->add('url', UrlType::class)
            ->add('insert', SubmitType::class, array('label' => 'Insert'))
            ->getForm();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Video::class);
        $movie = $repository->find($id);

        $form->get('id')->setData($movie->getId());
        $form->get('title')->setData($movie->getTitle());
        $form->get('description')->setData($movie->getDescription());
        $form->get('url')->setData($movie->getUrl());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $form->getClickedButton()) {
            $id =$request->get('form')['id'];
            $title=$request->get('form')['title'];
            $description=$request->get('form')['description'];
            $url=$request->get('form')['url'];
            $movie = $repository->find($id);
            $movie->setTitle($title);
            $movie->setDescription($description);
            $movie->setUrl($url);
            $em->flush();
            return $this->redirectToRoute("admincontroller");
        } else {
            $em->flush();
            return $this->render("edit.html.twig", array(
                'form' => $form->createView(),
                'title' => $movie->getTitle(),
                'description' => $movie->getDescription(),
                'url' => $movie->getUrl(),
            ));
        }
    }

}