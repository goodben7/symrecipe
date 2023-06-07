<?php

namespace App\Entity;

use App\Repository\CoteL1GenieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoteL1GenieRepository::class)]
class CoteL1Genie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tp1 = null;

    #[ORM\Column(length: 255)]
    private ?string $tp2 = null;

    #[ORM\Column(length: 255)]
    private ?string $interro1 = null;

    #[ORM\Column(length: 255)]
    private ?string $interro2 = null;

    #[ORM\OneToOne(inversedBy: 'coteL1Genie', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EtudiantL1Genie $etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'cotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->tp1 = '-';
        $this->tp2 = '-';
        $this->interro1 = '-';
        $this->interro2 = '-';
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTp1(): ?string
    {
        return $this->tp1;
    }

    public function setTp1(string $tp1): self
    {
        $this->tp1 = $tp1;

        return $this;
    }

    public function getTp2(): ?string
    {
        return $this->tp2;
    }

    public function setTp2(string $tp2): self
    {
        $this->tp2 = $tp2;

        return $this;
    }

    public function getInterro1(): ?string
    {
        return $this->interro1;
    }

    public function setInterro1(string $interro1): self
    {
        $this->interro1 = $interro1;

        return $this;
    }

    public function getInterro2(): ?string
    {
        return $this->interro2;
    }

    public function setInterro2(string $interro2): self
    {
        $this->interro2 = $interro2;

        return $this;
    }

    public function getEtudiant(): ?EtudiantL1Genie
    {
        return $this->etudiant;
    }

    public function setEtudiant(EtudiantL1Genie $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
