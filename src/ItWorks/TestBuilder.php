<?php

namespace ItWorks;

class TestBuilder {
	
	public function build($stepsDir, array $steps) {
		$tests = [];
		$stepsForTests = self::stepsForTests($steps);
		foreach ($stepsForTests as $testSteps) {
			$test = new Test();
			foreach ($testSteps as $stepPath) {
				$step = include "$stepsDir/$stepPath";
				$test->addNextStep($step);
			}
			$tests[] = $test;
		}

		return $tests;
	}

	private static function stepsForTests(array $tree, array $head = []) {
		static $flat = [];

		foreach ($tree as $key => $val) {
			$step = is_string($key)? $key : $val;
			$steps = array_merge($head, [$step]);

			if (is_array($val)) {
				self::stepsForTests($val, $steps);
			} else {
				$flat[] = $steps;
			}
		}

		return $flat;
	}

}