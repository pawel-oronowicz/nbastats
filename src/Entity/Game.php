<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $seasonId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $homeTeamId = null;

    #[ORM\Column]
    private ?int $awayTeamId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonId(): ?int
    {
        return $this->seasonId;
    }

    public function setSeasonId(int $seasonId): static
    {
        $this->seasonId = $seasonId;

        return $this;
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

    public function getHomeTeamId(): ?int
    {
        return $this->homeTeamId;
    }

    public function setHomeTeamId(int $homeTeamId): static
    {
        $this->homeTeamId = $homeTeamId;

        return $this;
    }

    public function getAwayTeamId(): ?int
    {
        return $this->awayTeamId;
    }

    public function setAwayTeamId(int $awayTeamId): static
    {
        $this->awayTeamId = $awayTeamId;

        return $this;
    }
}
