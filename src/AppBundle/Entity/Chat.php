<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chat
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChatRepository")
 */
class Chat
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
     * @ORM\ManyToOne(targetEntity="Joueur")
     */
    private $chatJoueur;

    /**
     * @ORM\ManyToOne(targetEntity="Partie")
     */
    private $chatPartie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="chat_date", type="datetime", nullable=true)
     */
    private $chatDate;

    /**
     * @var string
     *
     * @ORM\Column(name="chat_message", type="string", length=300)
     */
    private $chatMessage;

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
     * Set chatDate
     *
     * @param \DateTime $chatDate
     *
     * @return Chat
     */
    public function setChatDate($chatDate)
    {
        $this->chatDate = $chatDate;

        return $this;
    }

    /**
     * Get chatDate
     *
     * @return \DateTime
     */
    public function getChatDate()
    {
        return $this->chatDate;
    }

    /**
     * Set chatMessage
     *
     * @param string $chatMessage
     *
     * @return Chat
     */
    public function setChatMessage($chatMessage)
    {
        $this->chatMessage = $chatMessage;

        return $this;
    }

    /**
     * Get chatMessage
     *
     * @return string
     */
    public function getChatMessage()
    {
        return $this->chatMessage;
    }

    /**
     * Set chatJoueur
     *
     * @param \AppBundle\Entity\Joueur $chatJoueur
     *
     * @return Chat
     */
    public function setChatJoueur(\AppBundle\Entity\Joueur $chatJoueur = null)
    {
        $this->chatJoueur = $chatJoueur;

        return $this;
    }

    /**
     * Get chatJoueur
     *
     * @return \AppBundle\Entity\Joueur
     */
    public function getChatJoueur()
    {
        return $this->chatJoueur;
    }

    /**
     * Set chatPartie
     *
     * @param \AppBundle\Entity\Partie $chatPartie
     *
     * @return Chat
     */
    public function setChatPartie(\AppBundle\Entity\Partie $chatPartie = null)
    {
        $this->chatPartie = $chatPartie;

        return $this;
    }

    /**
     * Get chatPartie
     *
     * @return \AppBundle\Entity\Partie
     */
    public function getChatPartie()
    {
        return $this->chatPartie;
    }
}
