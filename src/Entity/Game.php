<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $HomeTeam = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $AwayTeam = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Season $Season = null;

    /**
     * @var Collection<int, PlayerBoxScore>
     */
    #[ORM\ManyToMany(targetEntity: PlayerBoxScore::class, mappedBy: 'Game')]
    private Collection $playerBoxScores;

    #[ORM\Column(length: 100)]
    private ?string $sourceId = null;

    public function __construct()
    {
        $this->playerBoxScores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHomeTeam(): ?Team
    {
        return $this->HomeTeam;
    }

    public function setHomeTeam(?Team $HomeTeam): static
    {
        $this->HomeTeam = $HomeTeam;

        return $this;
    }

    public function getAwayTeam(): ?Team
    {
        return $this->AwayTeam;
    }

    public function setAwayTeam(?Team $AwayTeam): static
    {
        $this->AwayTeam = $AwayTeam;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->Season;
    }

    public function setSeason(?Season $Season): static
    {
        $this->Season = $Season;

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
            $playerBoxScore->addGame($this);
        }

        return $this;
    }

    public function removePlayerBoxScore(PlayerBoxScore $playerBoxScore): static
    {
        if ($this->playerBoxScores->removeElement($playerBoxScore)) {
            $playerBoxScore->removeGame($this);
        }

        return $this;
    }

    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    public function setSourceId(string $sourceId): static
    {
        $this->sourceId = $sourceId;

        return $this;
    }
}
