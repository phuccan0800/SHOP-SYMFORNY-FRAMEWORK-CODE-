<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @vich\Uploadable
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $details;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $img;
   /**
     * @Vich\UploadableField(mapping="products", fileNameProperty="img")
     * @var File
     */
    private $imgFile;
    public function getId(): ?int
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

    public function getCategories(): ?Categories
    {
        return $this->Categories;
    }

    public function setCategories(?Categories $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

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
    /**
     * @return string|null
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @param  string|null $img
     * @return $this
     */
    public function setImg(?string $img): self
    {
        $this->img = $img;
        return $this;
    }
    /**
     * @return File|null
     */
    public function getImgFile(): ?File
    {
        return $this->imgFile;
    }

    /**
     * @param  File|null $$imgFile
     */
    public function setImgFile(?File $imgFile= null)
    {
        $this->imgFile = $imgFile;

    }
        public function __toString() {
        return $this->name;
    }
}
