<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, inversedBy="categories")
     */
    private $sous_categories;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, mappedBy="sous_categories")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Annonces::class, inversedBy="categories")
     */
    private $annonces;

    public function __construct()
    {
        $this->sous_categories = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sous_categories;
    }

    public function addSousCategory(self $sousCategory): self
    {
        if (!$this->sous_categories->contains($sousCategory)) {
            $this->sous_categories[] = $sousCategory;
        }

        return $this;
    }

    public function removeSousCategory(self $sousCategory): self
    {
        $this->sous_categories->removeElement($sousCategory);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addSousCategory($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeSousCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Annonces[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonces $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): self
    {
        $this->annonces->removeElement($annonce);

        return $this;
    }
}
