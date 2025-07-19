<?php

namespace App\Application\Gateway\FileGateway;

class FileGatewayRequest
{
    public function __construct(public readonly array $news) {} 
}