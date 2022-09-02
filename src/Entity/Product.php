<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $cost = null;

    #[ORM\Column]
    private ?float $selling_price = null;

    #[ORM\Column(nullable: true)]
    private ?float $margin = null;

    #[ORM\ManyToOne(inversedBy: 'product')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'product')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column]
    private ?int $tva = null;

    #[ORM\Column]
    private ?float $selling_price_ttc = null;

    #[ORM\Column(nullable: true)]
    private ?bool $bio = null;

    #[ORM\Column(nullable: true)]
    private ?bool $commerce_equitable = null;

    #[ORM\Column(nullable: true)]
    private ?bool $solidaire = null;

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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getSellingPrice(): ?float
    {
        return $this->selling_price;
    }

    public function setSellingPrice(float $selling_price): self
    {
        $this->selling_price = $selling_price;

        return $this;
    }

    public function getMargin(): ?float
    {
        return $this->margin;
    }

    public function setMargin(?float $margin): self
    {
        $this->margin = $margin;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getSellingPriceTtc(): ?float
    {
        return $this->selling_price_ttc;
    }

    public function setSellingPriceTtc(float $selling_price_ttc): self
    {
        $this->selling_price_ttc = $selling_price_ttc;

        return $this;
    }

    public function isBio(): ?bool
    {
        return $this->bio;
    }

    public function setBio(?bool $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function isCommerceEquitable(): ?bool
    {
        return $this->commerce_equitable;
    }

    public function setCommerceEquitable(?bool $commerce_equitable): self
    {
        $this->commerce_equitable = $commerce_equitable;

        return $this;
    }

    public function isSolidaire(): ?bool
    {
        return $this->solidaire;
    }

    public function setSolidaire(?bool $solidaire): self
    {
        $this->solidaire = $solidaire;

        return $this;
    }
    
}
