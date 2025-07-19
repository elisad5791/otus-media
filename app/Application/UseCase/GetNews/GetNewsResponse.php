<?php

namespace App\Application\UseCase\GetNews;

class GetNewsResponse
{
    public function __construct(public readonly array $news)  {} 
}