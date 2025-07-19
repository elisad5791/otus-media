<?php

namespace App\Infrastructure\Http;

use App\Application\UseCase\GetNews\GetNewsUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Throwable;

class GetNewsController extends Controller
{
    public function __construct(private GetNewsUseCase $useCase) {}

    public function __invoke(): JsonResponse
    {
        try {
            $response = ($this->useCase)();
            $message = $response->news;
            $code = 200;
        } catch (Throwable $e) {
            $message = ['error' => $e->getMessage()];
            $code = 400;
        }
        return response()->json($message, $code);
    }
}