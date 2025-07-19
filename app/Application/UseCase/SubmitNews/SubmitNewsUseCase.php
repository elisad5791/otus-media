<?php

namespace App\Application\UseCase\SubmitNews;

use App\Application\Gateway\HttpGateway\HttpGatewayInterface;
use App\Application\Gateway\HttpGateway\HttpGatewayRequest;
use App\Domain\Factory\NewsFactoryInterface;
use App\Domain\Repository\NewsRepositoryInterface;
use DOMDocument;

class SubmitNewsUseCase
{
    public function __construct(
        private readonly NewsFactoryInterface $newsFactory,
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly HttpGatewayInterface $httpGateway
    ) {}

    public function __invoke(SubmitNewsRequest $request): SubmitNewsResponse
    {
        $url = $request->url;

        $gatewayRequest = new HttpGatewayRequest($url);
        $gatewayResponse = $this->httpGateway->getTitle($gatewayRequest);

        $news = $this->newsFactory->create($gatewayResponse->title, $url, date('Y-m-d'));
        $this->newsRepository->save($news);
        return new SubmitNewsResponse($news->getId()->getValue());
    }
}