<?php

namespace App\Application\Factory;

use App\Domain\Factory\NewsFactoryInterface;
use App\Domain\ValueObject\CreationDate;
use App\Domain\ValueObject\Title;
use App\Domain\ValueObject\Url;
use App\Domain\Entity\News;

class NewsFactory implements NewsFactoryInterface
{
    public function create(string $title, string $url, string $creationDate): News
    {
        return new News(
            new Title($title),
            new Url($url),
            new CreationDate($creationDate)
        );
    }
}