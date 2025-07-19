<?php

namespace App\Application\Gateway\HttpGateway;

class HttpGatewayRequest
{
    public function __construct(public readonly string $url) {}   
}