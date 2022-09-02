<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Fournisseur::class, inversedBy: 'categories')]
    private Collection $lstFournisseur;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $lstProduct;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->lstFournisseur = new ArrayCollection();
        $this->lstProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getLstFournisseur(): Collection
    {
        return $this->lstFournisseur;
    }

    public function addFournisseur(Fournisseur $lstFournisseur): self
    {
        if (!$this->lstFournisseur->contains($lstFournisseur)) {
            $this->lstFournisseur->add($lstFournisseur);
            $lstFournisseur->setCategory($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $lstFournisseur): self
    {
        $this->lstFournisseur->removeElement($lstFournisseur);

        if ($lstFournisseur->getCategory() === $this) {
            $lstFournisseur->setCategory(null);
        }
        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getLstProduct(): Collection
    {
        return $this->lstProduct;
    }

    public function addProduct(Product $lstProduct): self
    {
        if (!$this->lstProduct->contains($lstProduct)) {
            $this->lstProduct->add($lstProduct);
            $lstProduct->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $lstProduct): self
    {
        if ($this->lstProduct->removeElement($lstProduct)) {
            // set the owning side to null (unless already changed)
            if ($lstProduct->getCategory() === $this) {
                $lstProduct->setCategory(null);
            }
        }

        return $this;
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
}
