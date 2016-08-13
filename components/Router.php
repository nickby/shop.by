<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $this->routes = require_once(ROOT . '/config/routes.php');
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');

            // убираем строку отладки из адреса
            $uri = preg_replace("~\?XDEBUG_SESSION_START=netbeans-xdebug~", '', $uri);
            //$uri = preg_replace("~shop\.by~", '', $uri);

            return $uri;
        }
    }

    public function Run()
    {
        $uri = $this->getURI();
        //echo $uri;
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments);
                $controllerName = ucfirst($controllerName) . 'Controller';

                $actionName = array_shift($segments);
                $actionName = 'action' . ucfirst($actionName);

                $params = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $params);
                //$result = $controllerObject->$actionName($params);
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
