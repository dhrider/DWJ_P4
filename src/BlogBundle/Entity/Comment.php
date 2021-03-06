<?php
// src/BlogBundle/Entity/Comment.php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(name="author", type="string", length=55)
     * @Assert\NotBlank()
     */
    protected $author;

    /**
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    protected $content;

    /**
     * @ORM\Column(name="signaled", type="boolean")
     */
    protected $signaled;

    /**
     * @ORM\Column(name="dateSignaled", type="datetime", nullable=true)
     */
    protected $dateSignaled;

    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Billet", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $billet;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->dateSignaled = null;
        $this->signaled = false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getSignaled()
    {
        return $this->signaled;
    }

    /**
     * @param mixed $signaled
     */
    public function setSignaled($signaled)
    {
        $this->signaled = $signaled;
    }

    /**
     * @return mixed
     */
    public function getDateSignaled()
    {
        return $this->dateSignaled;
    }

    /**
     * @param mixed $dateSignaled
     */
    public function setDateSignaled($dateSignaled)
    {
        $this->dateSignaled = $dateSignaled;
    }


    public function setBillet(Billet $billet)
    {
        $this->billet = $billet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillet()
    {
        return $this->billet;
    }
}
