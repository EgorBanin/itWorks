<?php

namespace ItWorks;

abstract class Step {
	
	protected function before() {

	}

	protected function after() {

	}

	abstract public function invoke();

	public function __invoke() {
		$this->before();
		$agrs = func_get_args();
		$result = $this->invoke($args)
		$this->after();
		
		return $result;
	}

}