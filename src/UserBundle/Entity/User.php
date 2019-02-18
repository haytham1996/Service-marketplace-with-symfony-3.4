<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $age;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $inscriptiondate;
    /**
     * @ORM\Column(type="string")
     *
     */
    private $nom;
    /**
     * @ORM\Column(type="string")
     *
     */
    private $prenom;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $gender;

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    /**
     * @return mixed
     */
    public function getgender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getadresse()
    {
        return $this->adresse;
    }
    /*
    /**
     * @return mixed
     */
    /*public function getdate_inscri()
    {
        return $this->date_inscri;
    }*/
    /**
     * @return mixed
     */
    public function getage()
    {
        return $this->age;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    /**
     * @param mixed $adresse
     */
    public function setadresse($adresse)
    {
        $this->adresse = $adresse;
    }
    /**
     * @param mixed $age
     */
    public function setage($age)
    {
        $this->age = $age;
    }

    ///**
     //* @param mixed $date_inscri
     //*/
    /*public function setdate_inscri($date_inscri)
    {
        $time=new \DateTime('now');
        $this->date_inscri = $time;
    }*/
    /**
     * @param mixed $gender
     */
    public function setgender($gender)
    {
        $this->gender = $gender;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setImage("");
        $this->setApropos("");
    }

    /**
     * Set inscriptiondate
     *
     * @param string $inscriptiondate
     *
     * @return User
     */
    public function setInscriptiondate($inscriptiondate)
    {
        $this->inscriptiondate = $inscriptiondate;

        return $this;
    }

    /**
     * Get inscriptiondate
     *
     * @return string
     */
    public function getInscriptiondate()
    {
        return $this->inscriptiondate;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
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
     * @ORM\Column(name="image", type="text",nullable=true)
     */
    private $image;

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
     * @var string
     *
     * @ORM\Column(name="apropos", type="string" , length=255,nullable=true)
     */
    private $apropos;
    /**
     * @return string
     */
    public function getApropos()
    {
        return $this->apropos;
    }
    /**
     * @param string $apropos
     */
    public function setApropos($apropos)
    {
        $this->apropos = $apropos;
    }

}
