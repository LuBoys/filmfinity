<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $moderation = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Users $users = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Films $films = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $rating = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->date_commentaire;
    }

    public function setDateCommentaire(?\DateTimeInterface $date_commentaire): static
    {
        $this->date_commentaire = $date_commentaire;

        return $this;
    }

    public function getModeration(): ?\DateTimeInterface
    {
        return $this->moderation;
    }

    public function setModeration(?\DateTimeInterface $moderation): static
    {
        $this->moderation = $moderation;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getFilms(): ?Films
    {
        return $this->films;
    }

    public function setFilms(?Films $films): static
    {
        $this->films = $films;

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