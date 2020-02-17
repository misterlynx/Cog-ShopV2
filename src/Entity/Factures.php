<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FacturesRepository")
 */
class Factures
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
    private $nomUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produitNom;

    /**
     * @ORM\Column(type="integer")
     */
    private $produitPrix;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): self
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getAdressUser(): ?string
    {
        return $this->adressUser;
    }

    public function setAdressUser(string $adressUser): self
    {
        $this->adressUser = $adressUser;

        return $this;
    }

    public function getProduitNom(): ?string
    {
        return $this->produitNom;
    }

    public function setProduitNom(string $produitNom): self
    {
        $this->produitNom = $produitNom;

        return $this;
    }

    public function getProduitPrix(): ?int
    {
        return $this->produitPrix;
    }

    public function setProduitPrix(int $produitPrix): self
    {
        $this->produitPrix = $produitPrix;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }
}
