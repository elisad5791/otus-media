<?php

namespace App\Application\Gateway\HttpGateway;

interface HttpGatewayInterface
{
    public function getTitle(HttpGatewayRequest $request): HttpGatewayResponse;
}