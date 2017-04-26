<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Query\AST\PartialObjectExpression;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JoueurRepository")
 */
class Joueur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="joueur_nom", type="string", length=30, nullable=true)
     */
    protected $joueurNom;

    /**
     * @var string
     *
     * @ORM\Column(name="joueur_prenom", type="string", length=30, nullable=true)
     */
    protected $joueurPrenom;

    /**
     * @var int
     *
     * @ORM\Column(name="joueur_highscore", type="integer", nullable=true)
     */
    protected $joueurHighscore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="joueur_inscription", type="datetime", nullable=true)
     */
    protected $joueurInscription;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partie", mappedBy="partieJ1")
     */
    private $parties_1;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partie", mappedBy="partieJ2")
     */
    private $parties_2;

    private $parties;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->parties_1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parties_2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getParties()
    {
        if (count($this->parties_1) > 0)
            $this->parties[] = $this->parties_1;

        if (count($this->parties_2) > 0)
            $this->parties[] = $this->parties_2;

        return $this->parties;
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
     * Set joueurNom
     *
     * @param string $joueurNom
     *
     * @return Joueur
     */
    public function setJoueurNom($joueurNom)
    {
        $this->joueurNom = $joueurNom;

        return $this;
    }

    /**
     * Get joueurNom
     *
     * @return string
     */
    public function getJoueurNom()
    {
        return $this->joueurNom;
    }

    /**
     * Set joueurPrenom
     *
     * @param string $joueurPrenom
     *
     * @return Joueur
     */
    public function setJoueurPrenom($joueurPrenom)
    {
        $this->joueurPrenom = $joueurPrenom;

        return $this;
    }

    /**
     * Get joueurPrenom
     *
     * @return string
     */
    public function getJoueurPrenom()
    {
        return $this->joueurPrenom;
    }

    /**
     * Set joueurHighscore
     *
     * @param integer $joueurHighscore
     *
     * @return Joueur
     */
    public function setJoueurHighscore($joueurHighscore)
    {
        $this->joueurHighscore = $joueurHighscore;

        return $this;
    }

    /**
     * Get joueurHighscore
     *
     * @return int
     */
    public function getJoueurHighscore()
    {
        return $this->joueurHighscore;
    }

    /**
     * Set joueurInscription
     *
     * @param \DateTime $joueurInscription
     *
     * @return Joueur
     */
    public function setJoueurInscription($joueurInscription)
    {
        $this->joueurInscription = $joueurInscription;

        return $this;
    }

    /**
     * Get joueurInscription
     *
     * @return \DateTime
     */
    public function getJoueurInscription()
    {
        return $this->joueurInscription;
    }

    /**
     * Add parties1
     *
     * @param \AppBundle\Entity\Partie $parties1
     *
     * @return Joueur
     */
    public function addParties1(\AppBundle\Entity\Partie $parties1)
    {
        $this->parties_1[] = $parties1;

        return $this;
    }

    /**
     * Remove parties1
     *
     * @param \AppBundle\Entity\Partie $parties1
     */
    public function removeParties1(\AppBundle\Entity\Partie $parties1)
    {
        $this->parties_1->removeElement($parties1);
    }

    /**
     * Get parties1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParties1()
    {
        return $this->parties_1;
    }

    /**
     * Add parties2
     *
     * @param \AppBundle\Entity\Partie $parties2
     *
     * @return Joueur
     */
    public function addParties2(\AppBundle\Entity\Partie $parties2)
    {
        $this->parties_2[] = $parties2;

        return $this;
    }

    /**
     * Remove parties2
     *
     * @param \AppBundle\Entity\Partie $parties2
     */
    public function removeParties2(\AppBundle\Entity\Partie $parties2)
    {
        $this->parties_2->removeElement($parties2);
    }

    /**
     * Get parties2
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParties2()
    {
        return $this->parties_2;
    }
    

}
