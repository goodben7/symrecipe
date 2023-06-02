<?php

namespace App\Entity;

use App\Repository\EtudiantL1GenieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtudiantL1GenieRepository::class)]
#[UniqueEntity('code')]
class EtudiantL1Genie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min:2,max:50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min:2,max:50)]
    private ?string $postnom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min:2,max:50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 1)]
    private ?string $sexe = null;

    #[ORM\Column(length: 8)]
    private ?string $code = null;

    #[ORM\OneToOne(mappedBy: 'etudiant', cascade: ['persist', 'remove'])]
    private ?CoteL1Genie $coteL1Genie = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->code = random_bytes(4);
        $this->code = (bin2hex($this->code)); 
        $this->code = strtoupper($this->code);
    }
    public function __toString()
    {
        return $this->nom; 
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
        $this->nom = strtoupper($nom);

        return $this;
    }

    public function getPostnom(): ?string
    {
        return $this->postnom;
    }

    public function setPostnom(string $postnom): self
    {
        $this->postnom = strtoupper($postnom);

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = ucfirst(strtolower($prenom));

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = strtoupper($sexe);

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = strtoupper($code);

        return $this;
    }

    public function getCoteL1Genie(): ?CoteL1Genie
    {
        return $this->coteL1Genie;
    }

    public function setCoteL1Genie(CoteL1Genie $coteL1Genie): self
    {
        // set the owning side of the relation if necessary
        if ($coteL1Genie->getEtudiant() !== $this) {
            $coteL1Genie->setEtudiant($this);
        }

        $this->coteL1Genie = $coteL1Genie;

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
