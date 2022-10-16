<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'likes', targetEntity:Article::class)]
    private ?Article $article = null;

    #[ORM\ManyToOne]
    private ?User $liker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getArticle(): ?Article
    // {
    //     return $this->article;
    // }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getLiker(): ?User
    {
        return $this->liker;
    }

    public function setLiker(?User $liker): self
    {
        $this->liker = $liker;

        return $this;
    }
}
