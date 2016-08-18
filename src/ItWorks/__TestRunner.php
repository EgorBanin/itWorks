<?php

namespace ItWorks;

class TestRunner {

	public function run(array $tests, array $params = []) {
		$results = [];
		foreach ($tests as $test) {
			// fixme
			$capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
			$wd = \RemoteWebDriver::create('http://192.168.50.1:4447/wd/hub', $capabilities);
			$params = [$wd];

			$results[] = $test->run($params);

			$wd->quit();
		}

		return $results;
	}

}