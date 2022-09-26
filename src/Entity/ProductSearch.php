<?php
namespace App\Entity;

class ProductSearch extends \App\Form\ProductSearchType {

    private $maxPrice;
    private $minPrice;

    /**
     * @return float|null
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * @param float|null $maxPrice
     */
    public function setMaxPrice(?float $maxPrice): ProductSearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    /**
     * @param float|null $minPrice
     */
    public function setMinPrice(?float $minPrice): ProductSearch
    {
        $this->minPrice = $minPrice;
        return $this;
    }
}