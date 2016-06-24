<?php

namespace ItWorks;

class TestRunner {

	public function run(array $tests, array $params = []) {
		$results = [];
		foreach ($tests as $test) {
			$results[] = $test->run($params);
		}

		return $results;
	}

}