<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $total = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?Formateur $formateur_id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $month = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdfPath = null;

//    /**
//     * @var Collection<int, InvoiceLine>
//     */
//    #[ORM\OneToMany(targetEntity: InvoiceLine::class, mappedBy: 'facture')]
//    private Collection $invoiceInline;


    #[ORM\ManyToOne(targetEntity: InvoiceLine::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?InvoiceLine $invoiceInline = null;



//    public function __construct()
//    {
//        $this->invoiceInline = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }






    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getFormateurId(): ?Formateur
    {
        return $this->formateur_id;
    }

    public function setFormateurId(?Formateur $formateur_id): static
    {
        $this->formateur_id = $formateur_id;

        return $this;
    }

    public function getMonth(): ?\DateTimeImmutable
    {
        return $this->month;
    }

    public function setMonth(\DateTimeImmutable  $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPdfPath(): ?string
    {
        return $this->pdfPath;
    }

    public function setPdfPath(?string $pdfPath): static
    {
        $this->pdfPath = $pdfPath;

        return $this;
    }

//    /**
//     * @return Collection<int, InvoiceLine>
//     */
//    public function getInvoiceInline(): Collection
//    {
//        return $this->invoiceInline;
//    }
//
//    public function addInvoiceInline(InvoiceLine $invoiceInline): static
//    {
//        if (!$this->invoiceInline->contains($invoiceInline)) {
//            $this->invoiceInline->add($invoiceInline);
//            $invoiceInline->setFacture($this);
//        }
//
//        return $this;
//    }
//
//    public function removeInvoiceInline(InvoiceLine $invoiceInline): static
//    {
//        if ($this->invoiceInline->removeElement($invoiceInline)) {
//            // set the owning side to null (unless already changed)
//            if ($invoiceInline->getFacture() === $this) {
//                $invoiceInline->setFacture(null);
//            }
//        }
//
//        return $this;
//    }


    public function getInvoiceInline(): ?InvoiceLine
    {
        return $this->invoiceInline;
    }

    public function setInvoiceInline(?InvoiceLine $invoiceInline): self
    {
        $this->invoiceInline = $invoiceInline;
        return $this;
    }
}
