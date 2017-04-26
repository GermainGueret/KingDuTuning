<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Familles
 *
 * @ORM\Table(name="familles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FamillesRepository")
 */
class Familles
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
     * @ORM\Column(name="famille_libele", type="string", length=100)
     */
    private $familleLibele;

    /**
     * @var string
     *
     * @ORM\Column(name="famille_couleur", type="string", length=50)
     */
    private $familleCouleur;

    /**
     * @ORM\OneToMany(targetEntity="Cartes", mappedBy="carteFamille")
     */
    private $cartes;


    public function __toString()
    {
        return $this->familleLibele;
    }

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
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
     * Set familleLibele
     *
     * @param string $familleLibele
     *
     * @return Familles
     */
    public function setFamilleLibele($familleLibele)
    {
        $this->familleLibele = $familleLibele;

        return $this;
    }

    /**
     * Get familleLibele
     *
     * @return string
     */
    public function getFamilleLibele()
    {
        return $this->familleLibele;
    }

    /**
     * Set familleCouleur
     *
     * @param string $familleCouleur
     *
     * @return Familles
     */
    public function setFamilleCouleur($familleCouleur)
    {
        $this->familleCouleur = $familleCouleur;

        return $this;
    }

    /**
     * Get familleCouleur
     *
     * @return string
     */
    public function getFamilleCouleur()
    {
        return $this->familleCouleur;
    }

    /**
     * Add carte
     *
     * @param \AppBundle\Entity\Cartes $carte
     *
     * @return Familles
     */
    public function addCarte(\AppBundle\Entity\Cartes $carte)
    {
        $this->cartes[] = $carte;

        return $this;
    }

    /**
     * Remove carte
     *
     * @param \AppBundle\Entity\Cartes $carte
     */
    public function removeCarte(\AppBundle\Entity\Cartes $carte)
    {
        $this->cartes->removeElement($carte);
    }

    /**
     * Get cartes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCartes()
    {
        return $this->cartes;
    }
}
