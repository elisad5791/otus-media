<?php

namespace App\Infrastructure\Http;

use App\Application\UseCase\SubmitNews\SubmitNewsRequest;
use App\Application\UseCase\SubmitNews\SubmitNewsUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class SubmitNewsController extends Controller
{
    public function __construct(private SubmitNewsUseCase $useCase) {}

    public function __invoke(Request $req): JsonResponse
    {
        $this->validate($req, ['url' => 'required|url']);
        $request = new SubmitNewsRequest($req->input('url'));

        try {
            $response = ($this->useCase)($request);
            $message = ['id' => $response->id];
            $code = 201;
        } catch (Throwable $e) {
            $message = ['error' => $e->getMessage()];
            $code = 400;
        }
        return response()->json($message, $code);
    }
}