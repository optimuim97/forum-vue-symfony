<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
 
    use ResourceId;
    use Timestapable;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'comments', targetEntity:Article::class)]
    #[ORM\JoinColumn(name:"article_id", referencedColumnName:"id", onDelete:"CASCADE")]
    private ?Article $article = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getArticle($need = false): ?Article
    {
        if($need == true){
            return $this->article;
        }else{
            return null;
        }
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }


    public function setArticle(?Article $article)  
    {
        $this->article = $article;

        return $this;
    }
}
