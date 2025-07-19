<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\CreationDate;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Title;
use App\Domain\ValueObject\Url;


class News
{
    private ?Id $id = null;  
  
    public function __construct(  
        private Title $title,  
        private Url $url,
        private CreationDate $creationDate
    )  {}  
  
    public function getId(): ?Id 
    {  
        return $this->id;  
    }  
  
    public function getTitle(): Title  
    {  
        return $this->title;  
    }  
  
    public function getUrl(): Url  
    {  
        return $this->url;  
    }  

    public function getCreationDate(): CreationDate  
    {  
        return $this->creationDate;
    }  
}