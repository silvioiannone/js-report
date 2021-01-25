<?php

namespace SI\JsReport;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

/**
 * JsReport client.
 */
class Client
{
    /**
     * HTTP client.
     */
    protected HttpClient $http;
    
    /**
     * Client constructor.
     */
    public function __construct(string $apiDomain, string $username, string $password)
    {
        $this->http = new HttpClient([
            'base_uri' => 'https://' . $apiDomain . '/api/',
            'auth' => [$username, $password],
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
    }
    
    /**
     * Render a report.
     */
    public function report(
        array $template,
        array $data = [],
        array $options = []
    ): ResponseInterface
    {
        return $this->http->post('report', [
            'json' => [
                'template' => $template,
                'data' => $data,
                'options' => $options
            ]
        ]);
    }
}
