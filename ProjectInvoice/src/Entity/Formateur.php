<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $adressePostal = null;

    #[ORM\Column]
    private ?int $codePostal = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    /**
     * @var Collection<int, Facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'formateur_id')]
    private Collection $factures;

//    /**
//     * @var Collection<int, Entreprise>
//     */
//    #[ORM\ManyToMany(targetEntity: Entreprise::class, mappedBy: 'formateur_id')]
//    private Collection $entreprises;

    /**
     * Relation OneToMany : un formateur peut avoir plusieurs entreprises
     * Pour imposer qu'un formateur ait au moins une entreprise, vous pourrez par exemple ajouter une contrainte de validation dans votre formulaire ou dans le validateur de l'entité.
     *
     * @var Collection<int, Entreprise>
     */
    #[ORM\OneToMany(mappedBy: 'formateur', targetEntity: Entreprise::class)]
    private Collection $entreprises;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection<int, Facture>
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): static
    {
        if (!$this->factures->contains($facture)) {
            $this->factures->add($facture);
            $facture->setFormateurId($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): static
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getFormateurId() === $this) {
                $facture->setFormateurId(null);
            }
        }

        return $this;
    }

//    /**
//     * @return Collection<int, Entreprise>
//     */
//    public function getEntreprises(): Collection
//    {
//        return $this->entreprises;
//    }
//
//    public function addEntreprise(Entreprise $entreprise): static
//    {
//        if (!$this->entreprises->contains($entreprise)) {
//            $this->entreprises->add($entreprise);
//            $entreprise->addFormateurId($this);
//        }
//
//        return $this;
//    }
//
//    public function removeEntreprise(Entreprise $entreprise): static
//    {
//        if ($this->entreprises->removeElement($entreprise)) {
//            $entreprise->removeFormateurId($this);
//        }
//
//        return $this;
//    }


    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->setFormateur($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // Si l'entreprise était liée à ce formateur, on la dissocie
            if ($entreprise->getFormateur() === $this) {
                $entreprise->setFormateur(null);
            }
        }

        return $this;
    }
}
