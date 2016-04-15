<?php

namespace notationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use notationBundle\Entity\Session;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="notationBundle\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     *
     *
     * @ORM\OneToMany(targetEntity="Session", mappedBy="enseignant")
     */
    private $session;


    public function __construct(){
        $this->session = new ArrayCollection();
    }


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
     * Set nom
     *
     * @param string $nom
     * @return Person
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
     * @return Person
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
     * Add session
     *
     * @param \notationBundle\Entity\Session $session
     * @return Person
     */
    public function addSession(\notationBundle\Entity\Session $session)
    {
        $this->session[] = $session;

        return $this;
    }

    /**
     * Remove session
     *
     * @param \notationBundle\Entity\Session $session
     */
    public function removeSession(\notationBundle\Entity\Session $session)
    {
        $this->session->removeElement($session);
    }

    /**
     * Get session
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSession()
    {
        return $this->session;
    }
}
