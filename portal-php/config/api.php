<?php

define('API_BASE_URL', 'http://localhost:3333');

function apiRequest(string $method, string $endpoint, array $data = []): array
{
    $url = API_BASE_URL . $endpoint;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method === 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return ['__api_offline' => true, 'error' => 'Serviço indisponível no momento.'];
    }

    $decoded = json_decode($response, true);

    if ($decoded === null) {
        return ['error' => 'Resposta inválida da API'];
    }

    return $decoded;
}

function apiOffline(array $resposta): bool
{
    return isset($resposta['__api_offline']);
}
