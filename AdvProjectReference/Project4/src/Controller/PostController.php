<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Services\Fetcher;
use App\Services\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PostController
 * @package App\Controller
 *
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/new", name="new.post")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        // request
        // $name = $request->get('name');

        /*-------------------------------------------------------------
         * explain difference between createForm & createFormBuilder
        ------------------------------------------------------------ */

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        $image = 'e029b1c29d86ea71f793d3f1a1e5ed2b.jpeg';

        if($form->isSubmitted() && $form->isValid())
        {
            // dump($request);

            # Upload File
            # ( post is a parameter )
            $file = $request->files->get('post')['my_file'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) .'.'. $file->guessExtension();

            $file->move(
                $uploads_directory,
                $filename
            );

            /* dd($file); */

            # save to the database
            /* $post->setImage($filename); */

            // save to db
            $em = $this->getDoctrine()->getManager();
            //$em->persist($post);
            //$em->flush();
        }


        return $this->render('home/greet.html.twig', [
            'post_form' => $form->createView(),
            'image' => $image
        ]);
    }


    /**
     * @Route("/uploads", name="uploads")
     * @param Request $request
     * @param Fetcher $fetcher
     * @return \Symfony\Component\HttpFoundation\Response
     */
    /*  public function uploads(Request $request, Fetcher $fetcher, Paginator $paginator) {} */
    public function uploads(Request $request, Fetcher $fetcher)
    {
        // URL : https://api.coinmarketcap.com/v2/listings/
        // request
        // $name = $request->get('name');

        /*-------------------------------------------------------------
         * explain difference between createForm & createFormBuilder
        ------------------------------------------------------------ */

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        $image = 'e029b1c29d86ea71f793d3f1a1e5ed2b.jpeg';

        if($form->isSubmitted() && $form->isValid())
        {
            // dump($request);

            # Multiple Upload
            $uploads_directory = $this->getParameter('uploads_directory');

            // get array of files
            $files = $request->files->get('post')['my_files'];

            // loop throught the files
            foreach($files as $file)
            {
                $filename = md5(uniqid()) .'.'. $file->guessExtension();
                $file->move(
                    $uploads_directory,
                    $filename
                );
            }

            /* dd($file); */

            # save to the database
            /* $post->setImage($filename); */

            // save to db
            $em = $this->getDoctrine()->getManager();
            //$em->persist($post);
            //$em->flush();
        }

        /* $result = $fetcher->get('https://api.coinmarketcap.com/v2/listings/'); */
        $result = $fetcher->get('www.google.com');
        # $partialArray = $paginator->getPartial($result['data'], 10, 10);

        return $this->render('home/greet.html.twig', [
            'post_form' => $form->createView(),
            'image' => $image,
            #'partial_array' => $partialArray
        ]);
    }


    /**
     * @Route("/show/{id}", name="show.post")
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request, Post $post)
    {
        return $this->render('home/show_post.html.twig', [
            'post' => $post
        ]);
    }
}
