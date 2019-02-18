<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\ParticipationRepository")
 */
class Participation
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="IdUser",referencedColumnName="id")
     *
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\evenement")
     * @ORM\JoinColumn(name="IdEvent",referencedColumnName="id")
     *
     */
    private $evenement;


    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Participation
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set evenement
     *
     * @param \EventBundle\Entity\evenement $evenement
     *
     * @return Participation
     */
    public function setEvenement(\EventBundle\Entity\evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \EventBundle\Entity\evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }
}
