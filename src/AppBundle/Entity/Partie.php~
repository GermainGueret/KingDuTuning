<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partie
 *
 * @ORM\Table(name="partie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartieRepository")
 */
class Partie
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Joueur", inversedBy="parties_1", fetch="EAGER")
     */
    private $partieJ1;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Joueur", inversedBy="parties_2", fetch="EAGER")
     */
    private $partieJ2;

    /**
     * @var int
     *
     * @ORM\Column(name="partie_score_j1", type="integer", nullable=true)
     */
    private $partieScoreJ1 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="partie_score_j2", type="integer", nullable=true)
     */
    private $partieScoreJ2 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="partie_tour", type="integer", nullable=true)
     */
    private $partieTour;

    /**
     * @var array
     *
     * @ORM\Column(name="partie_pioche", type="json_array", nullable=true)
     */
    private $partiePioche;

    /**
     * @var bool
     *
     * @ORM\Column(name="partie_pioche_active", type="boolean", nullable=true)
     */
    private $partiePiocheActive;

    /**
     * @var bool
     *
     * @ORM\Column(name="partie_carte_posee", type="boolean", nullable=true)
     */
    private $partieCartePosee;


    /**
     * @var array
     *
     * @ORM\Column(name="partie_plateau_j1", type="json_array", nullable=true)
     */
    private $partiePlateauJ1;

    /**
     * @var array
     *
     * @ORM\Column(name="partie_plateau_j2", type="json_array", nullable=true)
     */
    private $partiePlateauJ2;

    /**
     * @var array
     *
     * @ORM\Column(name="partie_defausse", type="json_array", nullable=true)
     */
    private $partieDefausse;

    /**
     * @var array
     *
     * @ORM\Column(name="partie_main_j1", type="json_array", nullable=true)
     */
    private $partieMainJ1;

    /**
     * @var array
     *
     * @ORM\Column(name="partie_main_j2", type="json_array", nullable=true)
     */
    private $partieMainJ2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="partie_date", type="datetime", nullable=true)
     */
    private $partieDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="partie_date_fin", type="datetime", nullable=true)
     */
    private $partieDateFin;

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
     * Set partieScoreJ1
     *
     * @param integer $partieScoreJ1
     *
     * @return Partie
     */
    public function setPartieScoreJ1($partieScoreJ1)
    {
        $this->partieScoreJ1 = $partieScoreJ1;

        return $this;
    }

    /**
     * Get partieScoreJ1
     *
     * @return int
     */
    public function getPartieScoreJ1()
    {
        return $this->partieScoreJ1;
    }

    /**
     * Set partieScoreJ2
     *
     * @param integer $partieScoreJ2
     *
     * @return Partie
     */
    public function setPartieScoreJ2($partieScoreJ2)
    {
        $this->partieScoreJ2 = $partieScoreJ2;

        return $this;
    }

    /**
     * Get partieScoreJ2
     *
     * @return int
     */
    public function getPartieScoreJ2()
    {
        return $this->partieScoreJ2;
    }

    /**
     * Set partieTour
     *
     * @param integer $partieTour
     *
     * @return Partie
     */
    public function setPartieTour($partieTour)
    {
        $this->partieTour = $partieTour;

        return $this;
    }

    /**
     * Get partieTour
     *
     * @return int
     */
    public function getPartieTour()
    {
        return $this->partieTour;
    }

    /**
     * Set partiePioche
     *
     * @param array $partiePioche
     *
     * @return Partie
     */
    public function setPartiePioche($partiePioche)
    {
        $this->partiePioche = $partiePioche;

        return $this;
    }

    /**
     * Get partiePioche
     *
     * @return array
     */
    public function getPartiePioche()
    {
        return $this->partiePioche;
    }

    /**
     * Set partiePlateauJ1
     *
     * @param array $partiePlateauJ1
     *
     * @return Partie
     */
    public function setPartiePlateauJ1($partiePlateauJ1)
    {
        $this->partiePlateauJ1 = $partiePlateauJ1;

        return $this;
    }

    /**
     * Get partiePlateauJ1
     *
     * @return array
     */
    public function getPartiePlateauJ1()
    {
        $j = json_decode($this->partiePlateauJ1);
        return $j;
    }

    /**
     * Set partiePlateauJ2
     *
     * @param array $partiePlateauJ2
     *
     * @return Partie
     */
    public function setPartiePlateauJ2($partiePlateauJ2)
    {
        $this->partiePlateauJ2 = $partiePlateauJ2;

        return $this;
    }

    /**
     * Get partiePlateauJ2
     *
     * @return array
     */
    public function getPartiePlateauJ2()
    {
        $j = json_decode($this->partiePlateauJ2);
        return $j;
    }

    /**
     * Set partieDefausse
     *
     * @param array $partieDefausse
     *
     * @return Partie
     */
    public function setPartieDefausse($partieDefausse)
    {
        $this->partieDefausse = $partieDefausse;

        return $this;
    }

    /**
     * Get partieDefausse
     *
     * @return array
     */
    public function getPartieDefausse()
    {
        $j = json_decode($this->partieDefausse);
        return $j;
    }

    /**
     * Set partieMainJ1
     *
     * @param array $partieMainJ1
     *
     * @return Partie
     */
    public function setPartieMainJ1($partieMainJ1)
    {
        $this->partieMainJ1 = $partieMainJ1;

        return $this;
    }

    /**
     * Get partieMainJ1
     *
     * @return array
     */
    public function getPartieMainJ1()
    {
        $j = json_decode($this->partieMainJ1);
        return $j;
    }

    /**
     * Set partieMainJ2
     *
     * @param array $partieMainJ2
     *
     * @return Partie
     */
    public function setPartieMainJ2($partieMainJ2)
    {
        $this->partieMainJ2 = $partieMainJ2;

        return $this;
    }

    /**
     * Get partieMainJ2
     *
     * @return array
     */
    public function getPartieMainJ2()
    {
        $j = json_decode($this->partieMainJ2);
        return $j;
    }

    /**
     * Set partieDate
     *
     * @param \DateTime $partieDate
     *
     * @return Partie
     */
    public function setPartieDate($partieDate)
    {
        $this->partieDate = $partieDate;

        return $this;
    }

    /**
     * Get partieDate
     *
     * @return \DateTime
     */
    public function getPartieDate()
    {
        return $this->partieDate;
    }

    /**
     * Set partieJ1
     *
     * @param \AppBundle\Entity\Joueur $partieJ1
     *
     * @return Partie
     */
    public function setPartieJ1(\AppBundle\Entity\Joueur $partieJ1 = null)
    {
        $this->partieJ1 = $partieJ1;

        return $this;
    }

    /**
     * Get partieJ1
     *
     * @return \AppBundle\Entity\Joueur
     */
    public function getPartieJ1()
    {
        return $this->partieJ1;
    }

    /**
     * Set partieJ2
     *
     * @param \AppBundle\Entity\Joueur $partieJ2
     *
     * @return Partie
     */
    public function setPartieJ2(\AppBundle\Entity\Joueur $partieJ2 = null)
    {
        $this->partieJ2 = $partieJ2;

        return $this;
    }

    /**
     * Get partieJ2
     *
     * @return \AppBundle\Entity\Joueur
     */
    public function getPartieJ2()
    {
        return $this->partieJ2;
    }

    /**
     * Set partieCartePosee
     *
     * @param boolean $partieCartePosee
     *
     * @return Partie
     */
    public function setPartieCartePosee($partieCartePosee)
    {
        $this->partieCartePosee = $partieCartePosee;

        return $this;
    }

    /**
     * Get partieCartePosee
     *
     * @return bool
     */
    public function getPartieCartePosee()
    {
        return $this->partieCartePosee;
    }

    /**
     * Set partiePiocheActive
     *
     * @param boolean $partiePiocheActive
     *
     * @return Partie
     */
    public function setPartiePiocheActive($partiePiocheActive)
    {
        $this->partiePiocheActive = $partiePiocheActive;

        return $this;
    }

    /**
     * Get partiePiocheActive
     *
     * @return boolean
     */
    public function getPartiePiocheActive()
    {
        return $this->partiePiocheActive;
    }

    /**
     * Set partieDateFin
     *
     * @param \DateTime $partieDateFin
     *
     * @return Partie
     */
    public function setPartieDateFin($partieDateFin)
    {
        $this->partieDateFin = $partieDateFin;

        return $this;
    }

    /**
     * Get partieDateFin
     *
     * @return \DateTime
     */
    public function getPartieDateFin()
    {
        return $this->partieDateFin;
    }
}
