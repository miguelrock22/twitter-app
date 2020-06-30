<?php
/**
 * Autoload all controllers for avoid require
 * 
 * @param String classname
 * @return void
 */

function autoLoad($classname){
	include 'controllers/' . $classname . '.php';
}

spl_autoload_register('autoLoad');