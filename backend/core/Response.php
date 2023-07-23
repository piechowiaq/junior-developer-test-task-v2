<?php

namespace app\core;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $path, $params = [])
    {
        extract($params);

        echo '<pre>';
        var_dump($params);
        echo '</pre>';

        exit();

        header("Location: $path");
        exit;
    }
}