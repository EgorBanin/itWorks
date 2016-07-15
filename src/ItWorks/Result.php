<?php

namespace ItWorks;

class Result {

	const FAILED = 'fail';

	const PASSED = 'pass';

	public $status = self::PASSED;

	private $steps = [];

	public function pass(Step $step) {
		$this->steps[] = $step;
	}
	
	public function fail(Step $step, $message) {
		$this->status = self::FAILED;
		$this->steps[] = $step;
		echo "$message\n";
	}

	public function error(Step $step, $message) {
		
	}

	public function getSteps() {
		return $this->steps;
	}

}