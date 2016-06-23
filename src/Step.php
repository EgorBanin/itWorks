<?php

namespace ItWorks;

class Step {

	private $description;

	private $impl;

	private $successAssertions = [];
	
	public function __construct($description, \Closure $impl) {
		$this->description = $description;
		$this->impl = $impl->bindTo($this);
	}

	public static function assert($description, $assertion) {
		if ($assertion) {
			$this->successAssertions[] = $description;
		} else {
			self::fail("Ложно: $description");
		}
	}

	public static function fail($message) {
		throw new StepFailException($message);
	}

	public function __invoke() {
		$agrs = func_get_args();
		$result = $this->impl($args)
		
		return $result;
	}

}