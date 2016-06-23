<?php

namespace ItWorks;

class Test {
	
	private $steps = [];

	private $result;

	public function __construct() {
		$this->result = new Result();
	}

	public function addNextStep($step) {
		$this->steps[] = $step;
	}

	public function run(array $params = []) {
		foreach ($this->steps as $step) {
			try {
				$result = $step($params);
			} catch(StepFailException $fail) {
				$this->result->fail($step, $fail->getMessage());
				break;
			} catch(\Exception $e) {
				$this->result->error($step, $e->getMessage());
				break;
			}
			$params = $result;
		}

		return $result;
	}

}