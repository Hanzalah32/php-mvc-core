<?php

namespace anzalahMvc\Core;

use anzalahmvc\core\middlewares\BaseMiddleware;

class controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
   * @var \anzalahmvc\core\middlewares\BaseMiddleware[]
 */
    protected array $middlewares = [];
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view,$params);
    }
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}