<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $selectAnimal = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $type = null;

    #[ORM\Column(length: 10)]
    private ?string $sexe = null;

    #[ORM\Column(length: 50)]
    private ?string $race = null;

    #[ORM\Column(length: 50)]
    private ?string $age = null;

    #[ORM\Column]
    private ?float $poids = null;

    #[ORM\Column(length: 15)]
    private ?string $numPuce = null;

    #[ORM\Column]
    private ?bool $sterilisation = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $dateChaleurs = null;

    #[ORM\Column(nullable: true)]
    private ?bool $medical = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ordonnanceFile = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $infoSup = null;

    #[ORM\Column(nullable: true)]
    private ?bool $vaccins = null;

    #[ORM\Column(nullable: true)]
    private ?bool $vermifuge = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alimentation = null;

    #[ORM\Column(nullable: true)]
    private ?bool $traitement = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getNumPuce(): ?string
    {
        return $this->numPuce;
    }

    public function setNumPuce(string $numPuce): self
    {
        $this->numPuce = $numPuce;

        return $this;
    }

    public function getSterilisation(): ?bool
    {
        return $this->sterilisation;
    }

    public function setSterilisation(bool $sterilisation): self
    {
        $this->sterilisation = $sterilisation;

        return $this;
    }

    public function getDateChaleurs(): ?string
    {
        return $this->dateChaleurs;
    }

    public function setDateChaleurs(string $dateChaleurs): self
    {
        $this->dateChaleurs = $dateChaleurs;

        return $this;
    }

    public function isMedical(): ?bool
    {
        return $this->medical;
    }

    public function setMedical(bool $medical): self
    {
        $this->medical = $medical;

        return $this;
    }

    public function getOrdonnanceFile(): ?string
    {
        return $this->ordonnanceFile;
    }

    public function setOrdonnanceFile(?string $ordonnanceFile): self
    {
        $this->ordonnanceFile = $ordonnanceFile;

        return $this;
    }

    public function getInfoSup(): ?string
    {
        return $this->infoSup;
    }

    public function setInfoSup(?string $infoSup): self
    {
        $this->infoSup = $infoSup;

        return $this;
    }

    public function isVaccins(): ?bool
    {
        return $this->vaccins;
    }

    public function setVaccins(bool $vaccins): self
    {
        $this->vaccins = $vaccins;

        return $this;
    }

    public function isVermifuge(): ?bool
    {
        return $this->vermifuge;
    }

    public function setVermifuge(bool $vermifuge): self
    {
        $this->vermifuge = $vermifuge;

        return $this;
    }

    public function isAlimentation(): ?bool
    {
        return $this->alimentation;
    }

    public function setAlimentation(bool $alimentation): self
    {
        $this->alimentation = $alimentation;

        return $this;
    }

    public function isTraitement(): ?bool
    {
        return $this->traitement;
    }

    public function setTraitement(?bool $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }
    
    public function getSelectAnimal(): ?string
    {
        return $this->selectAnimal;
    }

    public function setSelectAnimal(?string $selectAnimal): self
    {
        $this->selectAnimal = $selectAnimal;

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
    
    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setAnimal($this);
        }
        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getAnimal() === $this) {
                $reservation->setAnimal(null);
            }
        }
        return $this;
    }
}
