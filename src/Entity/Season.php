<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $yearFrom = null;

    #[ORM\Column]
    private ?int $yearTo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYearFrom(): ?int
    {
        return $this->yearFrom;
    }

    public function setYear(int $yearFrom): static
    {
        $this->yearFrom = $yearFrom;

        return $this;
    }

    public function getYearTo(): ?int
    {
        return $this->yearTo;
    }

    public function setYearTo(int $yearTo): static
    {
        $this->yearTo = $yearTo;

        return $this;
    }
}
