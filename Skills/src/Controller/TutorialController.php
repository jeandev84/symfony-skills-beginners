<?php
namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;



/**
 * Class TutorialController
 * @package App\Controller
 *
 * @Route("/tutorial", name="tutorial")
*/
class TutorialController extends AbstractController
{
    /**
     * @Route("/post/{id}")
     * @Entity("post", expr="repository.findPublishedById(id)", options={"converter"="custom_converter"})
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function getPost(Post $post)
    {
        return $this->render('tutorial/index.html.twig', [
            'controller_name' => 'TutorialController',
            'post' => $post
        ]);
    }
}
