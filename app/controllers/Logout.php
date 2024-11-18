<?php

class Logout
{
	public function __construct()
	{
		session_start();  // Memulai session
		session_destroy();  // Menghancurkan session untuk logout
		header('Location: ' . base_url . '/login');  // Redirect ke halaman login
		exit();  // Menghentikan eksekusi lebih lanjut setelah redirect
	}
}
