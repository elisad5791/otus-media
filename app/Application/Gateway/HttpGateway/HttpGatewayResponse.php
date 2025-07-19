<?php

namespace App\Application\Gateway\HttpGateway;

class HttpGatewayResponse
{
    public function __construct(public readonly string $title) {}
}