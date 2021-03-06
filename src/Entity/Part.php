<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartRepository")
 */
class Part
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $image;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PartType",inversedBy="parts")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car",inversedBy="parts")
     */
    private $car;

    /**
     * Part constructor.
     */
    public function __construct()
    {
        $this->setIsActive(false);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?array
    {
        return $this->image;
    }

    public function setImage(?array $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return PartType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PartType $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function __toString()
    {
        return (string)$this->name;
    }

    /**
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * @param Car $car
     */
    public function setCar($car): void
    {
        $this->car = $car;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

}
