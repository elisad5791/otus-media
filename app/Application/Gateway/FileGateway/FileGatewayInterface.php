<?php

namespace App\Application\Gateway\FileGateway;

interface FileGatewayInterface
{
    public function generateReport(FileGatewayRequest $request): FileGatewayResponse;
}