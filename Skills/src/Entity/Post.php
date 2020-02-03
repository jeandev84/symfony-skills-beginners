<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $title;


    /**
     * @ORM\Column(type="text", nullable=true)
    */
    private $content;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
    */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mapped="post", cascade={"persist", "remove"})
    */
    private $comments;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attachment", mapped="post", cascade={"persist", "remove"})
    */
    private $attachments;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="posts")
     * @Assert\NotBlank()
     * # Example : ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="posts", fetch="EAGER")
    */
    private $subCategory;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BookMark", mapped="post", cascade={"persist", "remove"})
    */
    private $bookmarks;


    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;


    /**
     * @ORM\Column(type="datetime", nullable=true)
    */
    private $published_at;


    /**
     * @ORM\Column(type="integer", options={"default": 0})
    */
    private $views_counter = 0;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $thumbnail;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getSubCategory(): ?SubCategory
    {
        return $this->sub_category;
    }

    public function setSubCategory(?SubCategory $sub_category): self
    {
        $this->sub_category = $sub_category;

        return $this;
    }
}
