<?php

class App
{

	protected $controller = 'Home';
	protected $method = 'index';
	protected $params = [];

	public function __construct()
	{
		$url = $this->parseURL();

		// Cek apakah $url ada dan apakah file controller ada
		if ($url !== null && file_exists('../app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller;

		// Cek apakah method ada di controller
		if (isset($url[1]) && method_exists($this->controller, $url[1])) {
			$this->method = $url[1];
			unset($url[1]);
		}

		// Ambil parameter jika ada
		if (!empty($url)) {
			$this->params = array_values($url);
		}

		// Jalankan controller dan method, serta kirim parameter jika ada
		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	public function parseURL()
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
		return null; // Kembalikan null jika tidak ada URL
	}
}
