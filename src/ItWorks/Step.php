<?php

namespace ItWorks;

class Step {

	private $description;

	private $impl;

	private $successAssertions = [];
	
	public function __construct($description, \Closure $impl) {
		$this->description = $description;
		$this->impl = $impl->bindTo($this, $this);
	}

	public function assert($description, $assertion) {
		if ($assertion) {
			$this->successAssertions[] = $description;
		} else {
			self::fail("Ложно: $description");
		}
	}

	public function fail($message) {
		throw new StepFailException($message);
	}

	public function __invoke() {
		$args = func_get_args();
		$result = call_user_func_array($this->impl, $args);
		
		return $result;
	}

	public function getDescription() {
		return $this->description;
	}

}