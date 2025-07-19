<?php

namespace App\Application\UseCase\SubmitNews;

class SubmitNewsResponse
{
    public function __construct(public readonly int $id)  {} 
}