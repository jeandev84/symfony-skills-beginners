<?php
namespace App\Services;


use App\Entity\Attachment;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class AttachmentManager
 * @package App\Services
*/
class AttachmentManager
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * AttachmentManager constructor.
     * @param ContainerInterface $container
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * @param UploadedFile $file
     */
    public function uploadAttachment(UploadedFile $file, Post $post)
    {
        $filename = md5(uniqid()). '.'. $file->guessExtension();

        $file->move(
           $this->getUploadsDir(),
           $filename
        );

        $attachment = new Attachment();

        $attachment->setFilename($filename);
        $attachment->setPath('/uploads/'. $filename);

        $attachment->setPost($post);

        $post->addAttachment($attachment);

        $this->entityManager->persist($attachment);
        $this->entityManager->flush();

        return [
           'filename' => $filename,
           'path' => '/uploads/'. $filename
        ];
    }


    /**
     * @return mixed
    */
    public function getUploadsDir()
    {
        return $this->container->getParameter('uploads');
    }
}