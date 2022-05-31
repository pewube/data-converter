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

    public function postParam(string $name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    public function filesParam(string $name, $default = null)
    {
        return $this->files[$name] ?? $default;
    }
}
