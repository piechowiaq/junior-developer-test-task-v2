<?php

namespace app\core;

class Router
{
    protected array $routes = [];

    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->response =$response;
        $this->request = $request;
    }

    public function get(string $path, array $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, array $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function delete(string $path, array $callback): string
    {
        return "Delete";
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false){
            $this->response->setStatusCode(404);
            return 'Not Found';
        }

        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        extract($params);

        include_once Application::$ROOT_DIR."/views/$view.php";
    }




}