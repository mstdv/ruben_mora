<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function BdFecha($f){

		$f = explode("/", $f);

		return "$f[2]-$f[0]-$f[1]";

	}

}
