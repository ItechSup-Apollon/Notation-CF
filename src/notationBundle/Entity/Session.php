<?php

namespace notationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use notationBundle\Entity\Person;

/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="notationBundle\Repository\SessionRepository")
 */
class Session
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
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Person",inversedBy="session")
     * @ORM\JoinColumn(name="enseignant_id",referencedColumnName="id")
     *
     */
    private  $enseignant;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Person",inversedBy="session")
     * @ORM\JoinColumn(name="eleve_id",referencedColumnName="id")
     *
     */
    private  $eleve;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return Session
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Session
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
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
     * @return Session
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
     * Set enseignant
     *
     * @param \notationBundle\Entity\Person $enseignant
     * @return Session
     */
    public function setEnseignant(\notationBundle\Entity\Person $enseignant = null)
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    /**
     * Get enseignant
     *
     * @return \notationBundle\Entity\Person
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eleve = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eleve
     *
     * @param \notationBundle\Entity\Person $eleve
     * @return Session
     */
    public function addEleve(\notationBundle\Entity\Person $eleve)
    {
        $this->eleve[] = $eleve;

        return $this;
    }

    /**
     * Remove eleve
     *
     * @param \notationBundle\Entity\Person $eleve
     */
    public function removeEleve(\notationBundle\Entity\Person $eleve)
    {
        $this->eleve->removeElement($eleve);
    }

    /**
     * Get eleve
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEleve()
    {
        return $this->eleve;
    }
}
