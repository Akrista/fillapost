<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LinkedInService
{
    protected $baseUrl;
    protected $accessToken;

    public function __construct()
    {
        $this->baseUrl = 'https://api.linkedin.com/v2';
        $this->accessToken = config('services.linkedin.access_token'); // Asegúrate de configurar esto en tu archivo de configuración
    }

    protected function request($method, $endpoint, $params = [])
    {
        $response = Http::withToken($this->accessToken)
            ->$method("{$this->baseUrl}/{$endpoint}", $params);

        if ($response->failed()) {
            // Manejo de errores
            throw new \Exception("Error en la solicitud a LinkedIn: " . $response->body());
        }

        return $response->json();
    }

    public function getProfile()
    {
        return $this->request('get', 'me');
    }

    public function getConnections($start = 0, $count = 10)
    {
        return $this->request('get', 'connections', [
            'start' => $start,
            'count' => $count
        ]);
    }

    // Agrega aquí otros métodos para diferentes endpoints de LinkedIn
}
