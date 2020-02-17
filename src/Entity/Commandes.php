<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandesRepository")
 */
class Commandes
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
    private $adresseuser;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $prix;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="commandes")
     */
    private $produits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeuser;

    /**
     * @ORM\Column(type="integer")
     */
    private $codepostal;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseuser(): ?string
    {
        return $this->adresseuser;
    }

    public function setAdresseuser(string $adresseuser): self
    {
        $this->adresseuser = $adresseuser;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
   public function __toString()
   {
           return $this->getPrix();
           return $this->getAdresseuser();
           return $this->getUser();
   }

   public function getVilleuser(): ?string
   {
       return $this->villeuser;
   }

   public function setVilleuser(string $villeuser): self
   {
       $this->villeuser = $villeuser;

       return $this;
   }

   public function getCodepostal(): ?int
   {
       return $this->codepostal;
   }

   public function setCodepostal(int $codepostal): self
   {
       $this->codepostal = $codepostal;

       return $this;
   }

}
