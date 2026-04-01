<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Concurrency::run([
            function () {
                sleep(2);
                return 'Hello, world!';
            },
            function () {
                sleep(2);
                return 'Hello, world2!';
            },
            function () {
                sleep(2);
                return 'Hello, world!3';
            },
        ]);

        $start = $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true);
        $elapsed = microtime(true) - $start;

        return response()->json([
            'message' => json_encode($result),
            'elapsed_seconds' => round($elapsed, 4),
        ]);
    }

    public function defer(): JsonResponse
    {
        Concurrency::defer([
            function () {
                sleep(2);
                Log::info('Deferred 1');
            },
            function () {
                sleep(2);
                Log::info('Deferred 2');
            },
            function () {
                sleep(2);
                Log::info('Deferred 3');
            },
        ]);

        $start = $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true);
        $elapsed = microtime(true) - $start;

        return response()->json([
            'message' => 'Deferred tasks scheduled; response returned without waiting for them.',
            'elapsed_seconds' => round($elapsed, 4),
        ]);
    }
}
