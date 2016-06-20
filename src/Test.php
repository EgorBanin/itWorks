<?php

namespace ItWorks;

class Test {
	
	protected $steps = [];


	public function addStep($step) {
		$this->steps[] = $step;
	}

}