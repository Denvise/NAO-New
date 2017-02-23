<?php

namespace NAO\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="observations")
 * @ORM\Entity(repositoryClass="NAO\CoreBundle\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="NAO\CoreBundle\Entity\User", inversedBy="observations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="NAO\CoreBundle\Entity\Species", inversedBy="observations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

    /**
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\Column(name="latitude", type="decimal", precision=18, scale=12)
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude", type="decimal", precision=18, scale=12)
     */
    private $longitude;

    /**
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(name="valid", type="boolean")
     */
    private $valid;

    public function getId()
    {
        return $this->id;
    }

    public function setUser(\NAO\CoreBundle\Entity\User $user)
    {
        $this->user = $user;
        $user->addObservation($this);
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setSpecies(\NAO\CoreBundle\Entity\Species $species)
    {
        $this->species = $species;
        $species->addObservation($this);
        return $this;
    }

    public function getSpecies()
    {
        return $this->species;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setValid($valid)
    {
        $this->valid = $valid;
        return $this;
    }

    public function getValid()
    {
        return $this->valid;
    }
}
