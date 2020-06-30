<?php

class database{
	public static function conectar(){
		$conexion = new mysqli("localhost", "root", "", "twitter_app");
		$conexion->query("SET NAMES 'utf8'");
		
		return $conexion;
	}
}
