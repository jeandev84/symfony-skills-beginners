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
     * @Route("/post/{start}/{end}")
     * # Route("/post/{title}")
     * # Route("/post/{id}")
     * @Entity("post", expr="repository.findPublishedById(id)", options={"converter"="custom_converter"})
     * # Entity("post", expr="repository.findPublishedById(id)", options={"entity_manager"="ValueOfEntityManager"})
     * @param \DateTime $dateTime
     * @return \Symfony\Component\HttpFoundation\Response
     */
    # public function getPost(Post $post) { }
    public function getPost(\DateTime $dateTime)
    {
        return $this->render('tutorial/index.html.twig', [
            'controller_name' => 'TutorialController',
            'post' => $post
        ]);
    }
}
