<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartes
 *
 * @ORM\Table(name="cartes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartesRepository")
 */
class Cartes
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
     * @var int
     *
     * @ORM\Column(name="carte_valeur", type="integer")
     */
    private $carteValeur;

    /**
     * @ORM\ManyToOne(targetEntity="Familles", inversedBy="cartes")
     */
    private $carteFamille;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_nom", type="string", length=50)
     */
    private $carteNom;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_description", type="string", length=200)
     */
    private $carteDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_texte", type="string", length=500)
     */
    private $carteTexte;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_image", type="string", length=50, nullable=true)
     */
    private $carteImage;

    /**
     * @var bool
     *
     * @ORM\Column(name="carte_extra", type="boolean")
     */
    private $carteExtra;


    public function __toString()
    {
        return $this->carteNom;
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
     * Set carteValeur
     *
     * @param integer $carteValeur
     *
     * @return Cartes
     */
    public function setCarteValeur($carteValeur)
    {
        $this->carteValeur = $carteValeur;

        return $this;
    }

    /**
     * Get carteValeur
     *
     * @return int
     */
    public function getCarteValeur()
    {
        return $this->carteValeur;
    }

    /**
     * Set carteNom
     *
     * @param string $carteNom
     *
     * @return Cartes
     */
    public function setCarteNom($carteNom)
    {
        $this->carteNom = $carteNom;

        return $this;
    }

    /**
     * Get carteNom
     *
     * @return string
     */
    public function getCarteNom()
    {
        return $this->carteNom;
    }

    /**
     * Set carteImage
     *
     * @param string $carteImage
     *
     * @return Cartes
     */
    public function setCarteImage($carteImage)
    {
        $this->carteImage = $carteImage;

        return $this;
    }

    /**
     * Get carteImage
     *
     * @return string
     */
    public function getCarteImage()
    {
        return $this->carteImage;
    }

    /**
     * Set carteExtra
     *
     * @param boolean $carteExtra
     *
     * @return Cartes
     */
    public function setCarteExtra($carteExtra)
    {
        $this->carteExtra = $carteExtra;

        return $this;
    }

    /**
     * Get carteExtra
     *
     * @return bool
     */
    public function getCarteExtra()
    {
        return $this->carteExtra;
    }

    /**
     * Set carteFamille
     *
     * @param \AppBundle\Entity\Familles $carteFamille
     *
     * @return Cartes
     */
    public function setCarteFamille(\AppBundle\Entity\Familles $carteFamille = null)
    {
        $this->carteFamille = $carteFamille;

        return $this;
    }

    /**
     * Get carteFamille
     *
     * @return \AppBundle\Entity\Familles
     */
    public function getCarteFamille()
    {
        return $this->carteFamille;
    }

    /**
     * Set carteDescription
     *
     * @param string $carteDescription
     *
     * @return Cartes
     */
    public function setCarteDescription($carteDescription)
    {
        $this->carteDescription = $carteDescription;

        return $this;
    }

    /**
     * Get carteDescription
     *
     * @return string
     */
    public function getCarteDescription()
    {
        return $this->carteDescription;
    }

    /**
     * Set carteTexte
     *
     * @param string $carteTexte
     *
     * @return Cartes
     */
    public function setCarteTexte($carteTexte)
    {
        $this->carteTexte = $carteTexte;

        return $this;
    }

    /**
     * Get carteTexte
     *
     * @return string
     */
    public function getCarteTexte()
    {
        return $this->carteTexte;
    }
}
