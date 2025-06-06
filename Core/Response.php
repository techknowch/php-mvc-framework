<?php

namespace APP\Core;

class Response
{
    protected int $statusCode = 200;

    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
        http_response_code($code);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function redirect(string $url): void
    {
        header("Location: " . $url);
        exit();
    }

    public function sendJson(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}