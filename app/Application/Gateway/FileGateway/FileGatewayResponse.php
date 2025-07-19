<?php

namespace App\Application\Gateway\FileGateway;

class FileGatewayResponse
{
    public function __construct(public readonly string $link) {}
}