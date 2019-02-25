<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\evenementRepository")
 * @Vich\Uploadable
 */
class evenement
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string",nullable=false,length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="nbnscription", type="integer")
     */
    private $nbnscription;

    /**
     * @ORM\ManyToOne(targetEntity="category")
     * @ORM\JoinColumn(name="IdCategory",referencedColumnName="id" )
     *
     */
    private $category ;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrJaime", type="integer")
     */
    private $nbrJaime;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return evenement
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return evenement
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return evenement
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return evenement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @Vich\UploadableField(mapping="profil_images", fileNameProperty="url")
     * @var File
     */
    private $imageFile;

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return evenement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return evenement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return evenement
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set nbnscription
     *
     * @param integer $nbnscription
     *
     * @return evenement
     */
    public function setNbnscription($nbnscription)
    {
        $this->nbnscription = $nbnscription;

        return $this;
    }

    /**
     * Get nbnscription
     *
     * @return int
     */
    public function getNbnscription()
    {
        return $this->nbnscription;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->datePublication = new \DateTime('now');
        }
    }
    public function getImageFile()
    {
        return $this->imageFile;
    }


    /**
     * Set category
     *
     * @param \EventBundle\Entity\category $category
     *
     * @return evenement
     */
    public function setCategory(\EventBundle\Entity\category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \EventBundle\Entity\category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set nbrJaime
     *
     * @param integer $nbrJaime
     *
     * @return evenement
     */
    public function setNbrJaime($nbrJaime)
    {
        $this->nbrJaime = $nbrJaime;

        return $this;
    }

    /**
     * Get nbrJaime
     *
     * @return integer
     */
    public function getNbrJaime()
    {
        return $this->nbrJaime;
    }
}
