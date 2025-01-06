<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $position = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $height = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $draftYear = null;

    #[ORM\Column(nullable: true)]
    private ?int $draftRound = null;

    #[ORM\Column(nullable: true)]
    private ?int $draftNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $college = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $Team = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $Country = null;

    /**
     * @var Collection<int, PlayerBoxScore>
     */
    #[ORM\ManyToMany(targetEntity: PlayerBoxScore::class, mappedBy: 'Player')]
    private Collection $playerBoxScores;

    #[ORM\Column]
    private ?int $sourceId = null;

    public function __construct()
    {
        $this->playerBoxScores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getDraftYear(): ?string
    {
        return $this->draftYear;
    }

    public function setDraftYear(?string $draftYear): static
    {
        $this->draftYear = $draftYear;

        return $this;
    }

    public function getDraftRound(): ?int
    {
        return $this->draftRound;
    }

    public function setDraftRound(?int $draftRound): static
    {
        $this->draftRound = $draftRound;

        return $this;
    }

    public function getDraftNumber(): ?int
    {
        return $this->draftNumber;
    }

    public function setDraftNumber(?int $draftNumber): static
    {
        $this->draftNumber = $draftNumber;

        return $this;
    }

    public function getCollege(): ?string
    {
        return $this->college;
    }

    public function setCollege(?string $college): static
    {
        $this->college = $college;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->Team;
    }

    public function setTeam(?Team $Team): static
    {
        $this->Team = $Team;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->Country;
    }

    public function setCountry(?Country $Country): static
    {
        $this->Country = $Country;

        return $this;
    }

    /**
     * @return Collection<int, PlayerBoxScore>
     */
    public function getPlayerBoxScores(): Collection
    {
        return $this->playerBoxScores;
    }

    public function addPlayerBoxScore(PlayerBoxScore $playerBoxScore): static
    {
        if (!$this->playerBoxScores->contains($playerBoxScore)) {
            $this->playerBoxScores->add($playerBoxScore);
            $playerBoxScore->addPlayer($this);
        }

        return $this;
    }

    public function removePlayerBoxScore(PlayerBoxScore $playerBoxScore): static
    {
        if ($this->playerBoxScores->removeElement($playerBoxScore)) {
            $playerBoxScore->removePlayer($this);
        }

        return $this;
    }

    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    public function setSourceId(int $sourceId): static
    {
        $this->sourceId = $sourceId;

        return $this;
    }
}
