<?php

namespace App\Domain\Factory;

use App\Domain\Entity\News;

interface NewsFactoryInterface
{
    public function create(string $title, string $url, string $creationDate): News;
}