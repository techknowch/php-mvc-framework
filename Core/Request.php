<?php

namespace APP\Core;

class Request
{
    protected string $method;
    protected string $uri;
    protected array $headers = [];
    protected array $body = [];

    public function __construct()
    {
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD'] ?? 'get');
    }

    public function getUri()
    {
        $path = $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $queryPos = strpos($path, '?');
        if ($queryPos !== false) {
            $path = substr($path, 0, $queryPos);
        }
        else {
            return $path;
        }
        return substr($path, 0, $queryPos);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}