<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Form\TutorialType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/api/getposts", methods={"GET"})
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
    public function getPosts(PostRepository $postRepository)
    {
        return $this->json([
            'posts' => $postRepository->getPosts(),
            'total' => $postRepository->getCountPosts()
        ]);
    }


    /**
     * @Route("/postform", name="post.form")
    */
    public function renderForm()
    {
        $form = $this->createForm(TutorialType::class);

        $view = $this->renderView('tutorial/form.html.twig', [
            'form' => $form->createView(),
        ]);


        return $this->json([
            'form' => $view,
            'title' => 'Create a new post'
        ]);
    }


    /**
     * @Route("/storePost", name="post.store")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function storePost(Request $request)
    {
        $tutorial = new Tutorial();
        $form = $this->createForm(TutorialType::class, $tutorial);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            return $this->json($tutorial);
        }

        return $this->json('empty');
    }


    /**
     * @Route("/posts", methods={"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function testerView(Request $request)
    {
        return $this->render('tutorial/index.html.twig');
    }
}
