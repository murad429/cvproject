<?php


namespace App\Controller;
use App\Entity\Video;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    /**
     * @Route("/user/delete/{id}", name="deletecontroller")
     */
    public function Delete($id)
    {
        $video = new Video();
        $em = $this->getDoctrine()->getManager();
        $mov = $em->getRepository(Video::class)->find($id);

        if (!$mov) {
            throw $this->createNotFoundException('No student found for id '.$id);
        }

        $em->remove($mov);

        $em->flush();

        return  $this->redirectToRoute("admincontroller");
}

}