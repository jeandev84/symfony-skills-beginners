<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class TutorialController
 * @package App\Controller
 *
 * @Route("/tutorial", name="tutorial")
 */
class TutorialController extends AbstractController
{
    /**
     * @Route("/tutorial", name="index")
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();

        return $this->render('tutorial/index.html.twig', [
            'controller_name' => 'TutorialController',
            'posts' => $posts
        ]);
    }


    /**
     * @Route("/posts", name="tutorial.posts")
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\DBAL\DBALException
     */
    public function posts(PostRepository $postRepository)
    {
        $posts = $postRepository->findPublishedPosts();

        return $this->render('tutorial/posts.html.twig', [
            'posts' => $posts
        ]);
    }


    /**
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function doSomething(PostRepository $postRepository)
    {
        $posts = $postRepository->findBy([
            'user' => 'Жан-Клод'
        ]);

        return $this->render('tutorial/posts.html.twig', [
            'posts' => $posts
        ]);
    }
}
