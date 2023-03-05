<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Products::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Products;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $customers;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): ?Products
    {
        return $this->Products;
    }

    public function setProducts(Products $Products): self
    {
        $this->Products = $Products;

        return $this;
    }

    public function getCustomers(): ?customers
    {
        return $this->customers;
    }

    public function setCustomers(?customers $customers): self
    {
        $this->customers = $customers;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
