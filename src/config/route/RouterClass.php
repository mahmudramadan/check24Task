<?php
 class RouterClass
{
    private array $routes;
    private array $completeUrl;
    private string $routeName;
    private string $requestMethod;
    private array $routePathInfo;
    private array $routeParams;


    public function __construct()
    {
        $this->routes = require_once __DIR__ . "/route.php";;
        $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $this->setCompleteUrl();
        $this->setRouteName();
        $this->setRoutePathInfo();
        $this->setRouteParams();
    }

    /**
     * @return array
     */
    public function getRouteParams(): array
    {
        return $this->routeParams;
    }

    /**
     * setRouteParams
     */
    private function setRouteParams(): void
    {
         if (count($this->completeUrl) > 1) {
            $this->routeParams = array_slice($this->completeUrl, 1);
        }else{
             $this->routeParams = [];
         }
    }


    /**
     * setCompleteUrl
     */
    private function setCompleteUrl(): void
    {
        if (!isset($_SERVER['PATH_INFO'])) {
            $this->completeUrl = ["home"];
        } else {
            $this->completeUrl = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
        }
    }

    /**
     * setRouteName
     */
    private function setRouteName(): void
    {
        $this->routeName = $this->completeUrl[0];
    }


    private function setRoutePathInfo(): void
    {
        if (!isset($this->routes[$this->routeName])) {
            $this->routeName = "404";
        }elseif ($this->requestMethod != strtolower($this->routes[$this->routeName]["requestMethod"])){
            $this->routeName = "404";
        }
        $this->routePathInfo = $this->routes[$this->routeName];
    }

    /**
     * @return array
     */
    public function getRoutePath(): array
    {
        return $this->routePathInfo;
    }


}