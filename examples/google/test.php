<?php

require __DIR__.'/bootstrap.php';

$tests = \ItWorks\TestBuilder::build(__DIR__.'/steps', [
	'openIndexPage.php' //=> [
		// 'search.php' //=> [
			// 'search/openImagesTab.php' => [
			// 	'search/images/selectImage.php',
			// ],
			// 'search/openVideoTab.php',
		// ],
		// 'doodles.php',
	// ],
]);
$capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
$wd = RemoteWebDriver::create('http://192.168.50.1:4447/wd/hub', $capabilities); 
$runner = new \ItWorks\TestRunner();
$results = $runner->run($tests, [$wd]);

var_export($results);