<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class FormController
 * @package App\Controller
 */
class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form.index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $post = new Post();
        /*
        $post->setTitle('Welcome');
        $post->setDescription('lorem ipsum something want to do description ...');
        */

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('form.index'), // bin/console debug:router (for see the available routes)
            /* 'method' => 'GET' by default method is POST for form */
        ]);

        /* Handle the request */
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // saving to the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->render('form/index.html.twig', [
            'post_form' => $form->createView(),
        ]);
    }

}
