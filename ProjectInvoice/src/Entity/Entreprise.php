<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $adressePostal = null;

    #[ORM\Column]
    private ?int $codepostal = null;

//    /**
//     * @var Collection<int, Formateur>
//     */
//    #[ORM\ManyToMany(targetEntity: Formateur::class, inversedBy: 'entreprises')]
//    private Collection $formateur_id;



    // Relation ManyToOne : une entreprise peut avoir un formateur ou pas
    #[ORM\ManyToOne(targetEntity: Formateur::class, inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Formateur $formateur = null;


//    public function __construct()
//    {
//        $this->formateur_id = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAdressePostal(): ?string
    {
        return $this->adressePostal;
    }

    public function setAdressePostal(string $adressePostal): static
    {
        $this->adressePostal = $adressePostal;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): static
    {
        $this->codepostal = $codepostal;

        return $this;
    }

//    /**
//     * @return Collection<int, Formateur>
//     */
//    public function getFormateurId(): Collection
//    {
//        return $this->formateur_id;
//    }
//
//    public function addFormateurId(Formateur $formateurId): static
//    {
//        if (!$this->formateur_id->contains($formateurId)) {
//            $this->formateur_id->add($formateurId);
//        }
//
//        return $this;
//    }
//
//    public function removeFormateurId(Formateur $formateurId): static
//    {
//        $this->formateur_id->removeElement($formateurId);
//
//        return $this;
//    }



    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }
}
