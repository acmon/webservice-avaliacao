<?php

namespace Src\Handler;

class Handler {

	function __construct($container)
	{
		$this->view = $container->view;
	}

}