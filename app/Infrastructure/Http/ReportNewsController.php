<?php

namespace App\Infrastructure\Http;

use App\Application\UseCase\ReportNews\ReportNewsRequest;
use App\Application\UseCase\ReportNews\ReportNewsUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ReportNewsController extends Controller
{
    public function __construct(private ReportNewsUseCase $useCase) {}

    public function __invoke(Request $req): JsonResponse
    {
        $this->validate($req, [
            'ids' => 'required|array',
            'ids.*' => 'required|integer',
        ]);
        $request = new ReportNewsRequest($req->input('ids'));

        try {
            $response = ($this->useCase)($request);
            $message = ['link' => $response->link];
            $code = 201;
        } catch (Throwable $e) {
            $message = ['error' => $e->getMessage()];
            $code = 400;
        }
        return response()->json($message, $code);
    }
}