<?php

class ApiService
{
    private $baseUrl = "http://localhost:3000";

    public function get($endpoint)
    {
        $url = $this->baseUrl . $endpoint;

        $response = file_get_contents($url);

        return json_decode($response, true);
    }
}