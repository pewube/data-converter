<?php

declare(strict_types=1);

namespace App;

class Request
{
    private array $get = [];
    private array $post = [];
    private array $files = [];

    public function __construct(array $get, array $post, array $files)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
    }

    public function getParam(string $name, $default = null)
    {
        return $this->get[$name] ?? $default;
    }

    public function getParams(): array
    {
        return $this->get ?? [];
    }

    public function postParam(string $name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    public function postParams(): array
    {
        return $this->post ?? [];
    }

    public function filesParam(string $name, $default = null)
    {
        return $this->files[$name] ?? $default;
    }

    public function filesParams(): array
    {
        return $this->files ?? [];
    }
}
