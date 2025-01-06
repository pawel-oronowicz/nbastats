<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private ?string $shortName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    /**
     * @var Collection<int, Player>
     */
    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: 'Team')]
    private Collection $players;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'HomeTeam')]
    private Collection $games;

    #[ORM\Column]
    private ?int $sourceId = null;

    /**
     * @var Collection<int, TeamHistory>
     */
    #[ORM\OneToMany(targetEntity: TeamHistory::class, mappedBy: 'Team')]
    private Collection $teamHistories;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->teamHistories = new ArrayCollection();
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

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): static
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setHomeTeam($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getHomeTeam() === $this) {
                $game->setHomeTeam(null);
            }
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

    /**
     * @return Collection<int, TeamHistory>
     */
    public function getTeamHistories(): Collection
    {
        return $this->teamHistories;
    }

    public function addTeamHistory(TeamHistory $teamHistory): static
    {
        if (!$this->teamHistories->contains($teamHistory)) {
            $this->teamHistories->add($teamHistory);
            $teamHistory->setTeam($this);
        }

        return $this;
    }

    public function removeTeamHistory(TeamHistory $teamHistory): static
    {
        if ($this->teamHistories->removeElement($teamHistory)) {
            // set the owning side to null (unless already changed)
            if ($teamHistory->getTeam() === $this) {
                $teamHistory->setTeam(null);
            }
        }

        return $this;
    }
}
