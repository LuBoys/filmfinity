<?php

namespace App\Entity;

use App\Repository\LikesFilmsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikesFilmsRepository::class)]
class LikesFilms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $likes_films = null;

    #[ORM\ManyToOne(targetEntity: Films::class, inversedBy: 'likes_films')]
    private $film;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'likes')]
    private $user;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $rating = null;

    public function __construct()
    {
        // Le constructeur est maintenant simplifié car nous n'avons plus d'ArrayCollection ici
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLikesFilms(): ?\DateTimeInterface
    {
        return $this->likes_films;
    }

    public function setLikesFilms(?\DateTimeInterface $likes_films): static
    {
        $this->likes_films = $likes_films;

        return $this;
    }

    public function getFilm(): ?Films
    {
        return $this->film;
    }

    public function setFilm(Films $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(Users $user): self
    {
        $this->user = $user;

        return $this;
    }

public function getRating(): ?int
{
    return $this->rating;
}

public function setRating(?int $rating): self
{
    $this->rating = $rating;

    return $this;
}
}
