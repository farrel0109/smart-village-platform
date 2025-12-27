<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RegionController extends Controller
{
    private const API_BASE = 'https://emsifa.github.io/api-wilayah-indonesia/api';
    private const CACHE_TTL = 86400; // 24 hours

    /**
     * Get all provinces.
     */
    public function provinces(): JsonResponse
    {
        $data = Cache::remember('regions_provinces', self::CACHE_TTL, function () {
            $response = Http::get(self::API_BASE . '/provinces.json');
            return $response->json();
        });

        return response()->json($data);
    }

    /**
     * Get regencies by province ID.
     */
    public function regencies(string $provinceId): JsonResponse
    {
        $data = Cache::remember("regions_regencies_{$provinceId}", self::CACHE_TTL, function () use ($provinceId) {
            $response = Http::get(self::API_BASE . "/regencies/{$provinceId}.json");
            return $response->json();
        });

        return response()->json($data);
    }

    /**
     * Get districts by regency ID.
     */
    public function districts(string $regencyId): JsonResponse
    {
        $data = Cache::remember("regions_districts_{$regencyId}", self::CACHE_TTL, function () use ($regencyId) {
            $response = Http::get(self::API_BASE . "/districts/{$regencyId}.json");
            return $response->json();
        });

        return response()->json($data);
    }

    /**
     * Get villages by district ID.
     */
    public function villages(string $districtId): JsonResponse
    {
        $data = Cache::remember("regions_villages_{$districtId}", self::CACHE_TTL, function () use ($districtId) {
            $response = Http::get(self::API_BASE . "/villages/{$districtId}.json");
            return $response->json();
        });

        return response()->json($data);
    }
}
