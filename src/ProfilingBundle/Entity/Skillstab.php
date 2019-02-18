<?php

namespace ProfilingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skillstab
 *
 * @ORM\Table(name="skillstab")
 * @ORM\Entity(repositoryClass="ProfilingBundle\Repository\SkillstabRepository")
 */
class Skillstab
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
     * @ORM\ManyToOne(targetEntity="ProfilingBundle\Entity\Skills")
     * @ORM\JoinColumn(name="IdSkill",referencedColumnName="id")
     *
     */
    private $skill;

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Skillstab
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
     * Set skill
     *
     * @param \ProfilingBundle\Entity\Skills $skill
     *
     * @return Skillstab
     */
    public function setSkill(\ProfilingBundle\Entity\Skills $skill = null)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \ProfilingBundle\Entity\Skills
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
