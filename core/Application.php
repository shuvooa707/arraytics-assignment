<?php
	
	namespace core;
	
	use controllers\UserController;
	
	final class Application
	{
		private Router $router;
		
		public function __construct()
		{
			$this->router = new Router();
		}
		
		public static function build(): Application
		{
			$application = new Application();
			$application->loadRoutes();
			return $application;
		}
		
		public function loadRoutes()
		{
			$routes = include_once "./routes/routes.php";
			foreach ($routes as $route) {
				$url = trim($route[0], "/");
				if ($route[1] == "get") {
					$this->router->get(
						$url,
						$route[2],
						$route[3]
					);
				}
				if ($route[1] == "post") {
//					print_r($route);
					$this->router->post(
						$url,
						$route[2],
						$route[3]
					);
				}
			}
		}
		
		public function setRouter(Router $router): void
		{
			$this->router = $router;
			
			$this->loadRoutes();
		}
		
		public function returnResponse(): string
		{
			return $this->runControllerMethod();
		}
		
		public function runControllerMethod(): string
		{
			$httpMethod = strtolower($_SERVER["REQUEST_METHOD"]);
			$url = $_SERVER["REQUEST_URI"];
			
			$routeUrlAction = $this->router->getRouteUrlAction($url, $httpMethod);
			
			// if route not found
			if (!$routeUrlAction) {
				echo "Page Not Found";
				exit(0);
			}
			
			$controller = $routeUrlAction->getController();
			$action = $routeUrlAction->getAction();
			
			return $controller->$action();
		}
	}