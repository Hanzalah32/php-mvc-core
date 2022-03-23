<?php

namespace anzalahmvc\core;

use anzalahmvc\core\Request;
use anzalahmvc\core\Response;
use anzalahmvc\core\Application;
use anzalahmvc\core\exception\NotFoundException;
use anzalahmvc\core\exception\ForbiddenException;


class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];
    


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->request->getpath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            // $this->response->setStatusCode(404);
            // return $this->renderView("_404");
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

     
        if (is_array($callback)) {
            /** @var \anzalahmvc\core\controller $controller */
            $controller= new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }
     
        return call_user_func($callback, $this->request, $this->response);
    
        // die($callback);
 
        // exit;
    }
    
    public function renderView($view, $params = [])
    {
       return Application::$app->view->renderView($view, $params);
    }
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {
        
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
        $layout = Application::$app->controller->layout;
    }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $params)
    {   
        foreach ($params as $key => $value) { 
            $$key  = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
