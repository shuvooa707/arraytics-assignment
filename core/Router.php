<?php
	
	namespace core;
	
	use controllers\ControllerInterface;
	
	class Router
	{
		private array $routes = [];
		
		public function __construct()
		{
		}
		
		public static function __callStatic(string $methodName, array $arguments)
		{
		
		}
		
		public function get(string $url, ControllerInterface $controller, string $action)
		{
			$this->registerRoute($url, "get", $controller, $action);
		}
		
		public function registerRoute(string $url, string $method, ControllerInterface $controller, string $action): void
		{
			$this->routes[] = new RouteUrlAction($url, $method, $controller, $action);
		}
		
		public function post(string $url, ControllerInterface $controller, string $action)
		{
			$this->registerRoute($url, "post", $controller, $action);
		}
		
		public function getRouteUrlAction(string $url, string $httpVerb): ?RouteUrlAction
		{
			// remove slashes
			$url = trim($url, "/");
			$url = explode("?", $url)[0];
			
			$routeUrlActions = $this->routes;
			foreach ($routeUrlActions as $routeUrlAction) {
				if ($routeUrlAction->getUrl() === $url && $routeUrlAction->getHttpVerb() === $httpVerb) {
					return $routeUrlAction;
				}
			}
			return null;
		}
	}