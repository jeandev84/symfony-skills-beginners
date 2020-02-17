<?php

namespace App\Controller;

use App\Entity\Post;
use App\Services\AttachmentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AttachmentController
 * @package App\Controller
*/
class AttachmentController extends AbstractController
{

    /**
     * @var AttachmentManager
     */
    private $attachmentManager;

    /**
     * AttachmentController constructor.
     * @param AttachmentManager $attachmentManager
    */
    public function __construct(AttachmentManager $attachmentManager)
    {
        $this->attachmentManager = $attachmentManager;
    }


    /**
     * @Route("/attachment/{id}", name="attachment")
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, Post $post)
    {
        $file = $request->files->get('file');

        $filenameAndPath = $this->attachmentManager->uploadAttachment($file, $post);

        return $this->json([
           'location' => $filenameAndPath['path']
        ]);
    }
}
