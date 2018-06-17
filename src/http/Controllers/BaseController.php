<?php

namespace Src\http\Controllers;

class BaseController {

	function __construct($container)
	{
		$this->container = $container;
	}

	function __get($property)
	{
		if($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

}