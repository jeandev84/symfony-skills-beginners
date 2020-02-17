<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HomeController
 * @package App\Controller
 *
 * @Route("/home", name="home.")
*/
class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/newpost", name="new.post")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newPost(Request $request)
    {
        // request
        // $name = $request->get('name');

        /*-------------------------------------------------------------
         * explain difference between createForm & createFormBuilder
        ------------------------------------------------------------ */

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            // save to db
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }


        return $this->render('home/greet.html.twig', [
          'post_form' => $form->createView()
       ]);
    }


    /**
     * @Route("/showPost/{id}", name="show.post")
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPost(Request $request, Post $post)
    {
        return $this->render('home/show_post.html.twig', [
            'post' => $post
        ]);
    }
}
