<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase{

    protected Article $article;

    protected function setUp():void
    {
        $this->article = new Article();
        parent::setUp(); 
    }    

    public function testGetTitle(){
        $value = "Titre";

        $response= $this->article->setTitle($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $this->article->getTitle());
    }

    public function testGetContent():void {
        $value = "lorem lorem lorem";

        $response = $this->article->setContent($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $this->article->getContent());

    }

    public function testGetAuthor():void{
        
        $user = new User();
        $response = $this->article->setAuthor($user);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($user, $this->article->getAuthor());
    }
}   