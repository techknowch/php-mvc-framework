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
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->headers = getallheaders();
        $this->body = json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        $path = $this->uri;
        $queryPos = strpos($path, '?');
        if ($queryPos !== false) {
            $path = substr($path, 0, $queryPos);
        }
        return rtrim($path, '/');
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