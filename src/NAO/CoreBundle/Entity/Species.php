<?php

namespace NAO\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="species")
 * @ORM\Entity(repositoryClass="NAO\CoreBundle\Repository\SpeciesRepository")
 */
class Species
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="NAO\CoreBundle\Entity\Observation", mappedBy="species", cascade={"persist", "remove"})
     */
    private $observations;

    /**
     * @ORM\Column(name="ref", type="integer")
     */
    private $ref;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(name="vern_name", type="string", length=255, nullable=true)
     */
    private $vernName;

    /**
     * @ORM\Column(name="rank", type="string", length=255)
     */
    private $rank;

    /**
     * @ORM\Column(name="phylum", type="string", length=255)
     */
    private $phylum;

    /**
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;

    /**
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(name="family", type="string", length=255)
     */
    private $family;

    /**
     * @ORM\Column(name="habitat", type="string", length=255)
     */
    private $habitat;

    public function __construct()
    {
        $this->observations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addObservation(\NAO\CoreBundle\Entity\Observation $observation)
    {
        $this->observations[] = $observation;
        return $this;
    }

    public function removeObservation(\NAO\CoreBundle\Entity\Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    public function getObservations()
    {
        return $this->observations;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setVernName($vernName)
    {
        $this->vernName = $vernName;
        return $this;
    }

    public function getVernName()
    {
        return $this->vernName;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function setPhylum($phylum)
    {
        $this->phylum = $phylum;
        return $this;
    }

    public function getPhylum()
    {
        return $this->phylum;
    }

    public function setClasse($classe)
    {
        $this->classe = $classe;
        return $this;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setFamily($family)
    {
        $this->family = $family;
        return $this;
    }

    public function getFamily()
    {
        return $this->family;
    }

    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;
        return $this;
    }

    public function getHabitat()
    {
        return $this->habitat;
    }
}
