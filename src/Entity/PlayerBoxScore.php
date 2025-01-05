<?php

namespace App\Entity;

use App\Repository\PlayerBoxScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerBoxScoreRepository::class)]
class PlayerBoxScore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $gameId = null;

    #[ORM\Column]
    private ?int $playerId = null;

    #[ORM\Column]
    private ?int $minutes = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $fieldGoalsMade = null;

    #[ORM\Column]
    private ?int $fieldGoalsAttempted = null;

    #[ORM\Column]
    private ?int $threePointersMade = null;

    #[ORM\Column]
    private ?int $threePointersAttempted = null;

    #[ORM\Column]
    private ?int $freeThrowsMade = null;

    #[ORM\Column]
    private ?int $freeThrowsAttempted = null;

    #[ORM\Column]
    private ?int $reboundsDefensive = null;

    #[ORM\Column]
    private ?int $reboundsOffensive = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column]
    private ?int $steals = null;

    #[ORM\Column]
    private ?int $blocks = null;

    #[ORM\Column]
    private ?int $turnovers = null;

    #[ORM\Column]
    private ?int $fouls = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): static
    {
        $this->gameId = $gameId;

        return $this;
    }

    public function getPlayerId(): ?int
    {
        return $this->playerId;
    }

    public function setPlayerId(int $playerId): static
    {
        $this->playerId = $playerId;

        return $this;
    }

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(int $minutes): static
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getFieldGoalsMade(): ?int
    {
        return $this->fieldGoalsMade;
    }

    public function setFieldGoalsMade(int $fieldGoalsMade): static
    {
        $this->fieldGoalsMade = $fieldGoalsMade;

        return $this;
    }

    public function getFieldGoalsAttempted(): ?int
    {
        return $this->fieldGoalsAttempted;
    }

    public function setFieldGoalsAttempted(int $fieldGoalsAttempted): static
    {
        $this->fieldGoalsAttempted = $fieldGoalsAttempted;

        return $this;
    }

    public function getThreePointersMade(): ?int
    {
        return $this->threePointersMade;
    }

    public function setThreePointersMade(int $threePointersMade): static
    {
        $this->threePointersMade = $threePointersMade;

        return $this;
    }

    public function getThreePointersAttempted(): ?int
    {
        return $this->threePointersAttempted;
    }

    public function setThreePointersAttempted(int $threePointersAttempted): static
    {
        $this->threePointersAttempted = $threePointersAttempted;

        return $this;
    }

    public function getFreeThrowsMade(): ?int
    {
        return $this->freeThrowsMade;
    }

    public function setFreeThrowsMade(int $freeThrowsMade): static
    {
        $this->freeThrowsMade = $freeThrowsMade;

        return $this;
    }

    public function getFreeThrowsAttempted(): ?int
    {
        return $this->freeThrowsAttempted;
    }

    public function setFreeThrowsAttempted(int $freeThrowsAttempted): static
    {
        $this->freeThrowsAttempted = $freeThrowsAttempted;

        return $this;
    }

    public function getReboundsDefensive(): ?int
    {
        return $this->reboundsDefensive;
    }

    public function setReboundsDefensive(int $reboundsDefensive): static
    {
        $this->reboundsDefensive = $reboundsDefensive;

        return $this;
    }

    public function getReboundsOffensive(): ?int
    {
        return $this->reboundsOffensive;
    }

    public function setReboundsOffensive(int $reboundsOffensive): static
    {
        $this->reboundsOffensive = $reboundsOffensive;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): static
    {
        $this->assists = $assists;

        return $this;
    }

    public function getSteals(): ?int
    {
        return $this->steals;
    }

    public function setSteals(int $steals): static
    {
        $this->steals = $steals;

        return $this;
    }

    public function getBlocks(): ?int
    {
        return $this->blocks;
    }

    public function setBlocks(int $blocks): static
    {
        $this->blocks = $blocks;

        return $this;
    }

    public function getTurnovers(): ?int
    {
        return $this->turnovers;
    }

    public function setTurnovers(int $turnovers): static
    {
        $this->turnovers = $turnovers;

        return $this;
    }

    public function getFouls(): ?int
    {
        return $this->fouls;
    }

    public function setFouls(int $fouls): static
    {
        $this->fouls = $fouls;

        return $this;
    }
}
