<?php
	
	namespace core;
	
	use controllers\ControllerInterface;
	
	class RouteUrlAction
	{
		private string $url;
		private string $httpVerb;
		private ControllerInterface $controller;
		private string $action;
		
		
		public function __construct(string $url, string $httpVerb, ControllerInterface $controller, string $action)
		{
			$this->url = $url;
			$this->httpVerb = $httpVerb;
			$this->controller = $controller;
			$this->action = $action;
		}
		
		public function getUrl(): string
		{
			return $this->url;
		}
		
		public function setUrl(string $url): void
		{
			$this->url = $url;
		}
		
		public function getController(): ControllerInterface
		{
			return $this->controller;
		}
		
		public function setController(ControllerInterface $controller): void
		{
			$this->controller = $controller;
		}
		
		public function getAction(): string
		{
			return $this->action;
		}
		
		public function setAction(string $action): void
		{
			$this->action = $action;
		}
		
		public function getHttpVerb(): string
		{
			return $this->httpVerb;
		}
		
		public function setHttpVerb(string $httpVerb): void
		{
			$this->httpVerb = $httpVerb;
		}
	}