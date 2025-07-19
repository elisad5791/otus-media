<?php

namespace App\Application\UseCase\GetNews;

use App\Domain\Repository\NewsRepositoryInterface;
use DOMDocument;

class GetNewsUseCase
{
    public function __construct(
        private readonly NewsRepositoryInterface $newsRepository,
    ) {}

    public function __invoke(): GetNewsResponse
    {
        $news = $this->newsRepository->findAll();
        $response = new GetNewsResponse($news);
        return $response;
    }
}