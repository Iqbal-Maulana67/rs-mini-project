<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RsApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.rs_api.base_url');
    }

    public function getToken(): string
    {
        return Cache::remember('rs_api_token', 86000, function () {
            $response = Http::post("{$this->baseUrl}/auth", [
                'email'    => config('services.rs_api.email'),
                'password' => config('services.rs_api.password'),
            ]);

            return $response->json('access_token');
        });
    }

    protected function request(string $endpoint)
    {
        return Http::withToken($this->getToken())
            ->get("{$this->baseUrl}/{$endpoint}")
            ->throw()
            ->json();
    }

    public function getInsurances()
    {
        return $this->request('insurances');
    }

    public function getProcedures()
    {
        return $this->request('procedures');
    }

    public function getProcedurePrices(string $procedureId)
    {
        return $this->request("procedures/{$procedureId}/prices");
    }
}
