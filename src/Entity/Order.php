<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cnt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Part")
     */
    private $part;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TicketPart",inversedBy="orders")
     */
    private $ticket;

    public function getId()
    {
        return $this->id;
    }

    public function getCnt(): ?int
    {
        return $this->cnt;
    }

    public function setCnt(int $cnt): self
    {
        $this->cnt = $cnt;

        return $this;
    }

    /**
     * @return Part
     */
    public function getPart()
    {
        return $this->part;
    }

    /**
     * @param Part $part
     */
    public function setPart($part): void
    {
        $this->part = $part;
    }

    /**
     * @return TicketService
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param TicketService $ticket
     */
    public function setTicket($ticket): void
    {
        $this->ticket = $ticket;
    }
}
