<?php

require __DIR__.'/bootstrap.php';

$graph = new \ItWorks\Graph([
	'homePage' => ['searchResults'],
	'searchResults' => ['searchResults/images'],
	'searchResults/images' => [],
]);
$nodes = $graph->resolvePath(
	\ItWorks\Path::homePage()
		->searchResults('foo')
		->{'searchResults/images'}()
);
$runner = new \ItWorks\TestRunner(__DIR__.'/graph');
// fixme
$capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
$wd = \RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
$wd->get('https://google.com');
$runner->run($nodes, [$wd]);
$wd->quit();
