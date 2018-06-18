<?php

namespace Src\http\Controllers\Estado;

use Src\http\Controllers\BaseController as BaseController;
use Src\Models\Estado\Estado as Estado;

//#TODO - isolar avaliacao.estados
class Controller extends BaseController {

	public function definirModel() {

		return new Estado($this->container);

	}

}