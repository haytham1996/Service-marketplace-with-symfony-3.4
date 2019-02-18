<?php

namespace ProfilingBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ProfilingBundle\Repository\PostRepository")
 */
class Post
{


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;

    /**
     * @var string
     * @Assert\File(
     *      maxSize="5242880",
     *      mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif"
     *      }
     * )
     * @ORM\Column(name="image", type="text")
     */
    private $image;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->datePublication = new \DateTime();
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Post
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Post
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User" ,cascade={"persist"})
     * @ORM\JoinColumn(name="IdUser",referencedColumnName="id")
     *
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="ProfilingBundle\Entity\Tag" ,cascade={"persist"})
     * @ORM\JoinColumn(name="IdTag",referencedColumnName="id")
     *
     */
    private $tag;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }


    /**
     * Add tag
     *
     * @param \ProfilingBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\ProfilingBundle\Entity\Tag $tag)
    {
        $this->tag[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \ProfilingBundle\Entity\Tag $tag
     */
    public function removeTag(\ProfilingBundle\Entity\Tag $tag)
    {
        $this->tag->removeElement($tag);
    }
}
