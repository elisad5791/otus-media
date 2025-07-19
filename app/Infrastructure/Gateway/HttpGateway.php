<?php

namespace App\Infrastructure\Gateway;

use App\Application\Gateway\HttpGateway\HttpGatewayInterface;
use App\Application\Gateway\HttpGateway\HttpGatewayRequest;
use App\Application\Gateway\HttpGateway\HttpGatewayResponse;
use DOMDocument;

class HttpGateway implements HttpGatewayInterface
{
    public function getTitle(HttpGatewayRequest $request): HttpGatewayResponse
    {
        $url = $request->url;

        $content = file_get_contents($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($content);
        $title = $dom->getElementsByTagName('title')->item(0)->nodeValue ?? 'Title not found';

        return new HttpGatewayResponse($title);
    }
}