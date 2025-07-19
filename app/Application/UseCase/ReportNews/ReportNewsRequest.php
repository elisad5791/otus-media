<?php

namespace App\Application\UseCase\ReportNews;

class ReportNewsRequest
{
    public function __construct(public readonly array $ids)  {}
}