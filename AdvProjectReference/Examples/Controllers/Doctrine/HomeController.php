<?php

namespace App\Controller;

use App\Entity\Post;
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
     * @Route("/helloUser/{name?}", name="hello_user")
     * @param Request $request
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    /*
       Route("/helloUser/{name?}", name="hello_user", method={"GET", "POST"}"
       public function helloUser($name) {}
       public function helloUser(Request $request) {}
    */
    public function helloUser(Request $request, $name)
    {
        // request
        // $name = $request->get('name');

        /*-------------------------------------------------------------
         * explain difference between createForm & createFormBuilder
        --------------------------------------------------------------*/
        $form = $this->createFormBuilder()
            ->add('fullname', TextType::class)
            ->getForm();

        $person = [
            'name' => 'Jean-Claude',
            'lastname' => 'Yao',
            'age' => 35
        ];

        /* ------------------------------------------
         * Store Stuff in the database
        ---------------------------------------------*/
        $post = new Post();

        $post->setTitle("overseas media");
        $post->setDescription("youtube channel for web shit");


        $em = $this->getDoctrine()->getManager();

        /*
        # return one result where condition
        $retrievedPost = $em->getRepository(Post::class)->findOneBy(['description' => 'description value');

        # return all result where condition
        $retrievedPost = $em->getRepository(Post::class)->findBy([
            'id' => 1
        ]);

        # return all posts
        $retrievedPost = $em->getRepository(Post::class)->findAll();
        */
        $retrievedPost = $em->getRepository(Post::class)->findOneBy([
            'id' => 1
        ]);

        echo '<pre>';
        var_dump($retrievedPost);
        echo '</pre>';
        // create the sql
        //$em->persist($post);
        $em->remove($retrievedPost);

        // call it at the end
        $em->flush();

        return $this->render('home/greet.html.twig', [
            'person' => $person,
            'post' => $post,
            'user_form'  => $form->createView()
        ]);
    }
}
