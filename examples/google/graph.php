<?php

require __DIR__.'/bootstrap.php';

$graph = new \ItWorks\Graph([
	'homePage' => ['searchResults'],
	'searchResults' => ['searchResults_images'],
	'searchResults_images' => [],
]);
$nodes = $graph->resolvePath(
	\ItWorks\Path::homePage()
		->searchResults('foo')
		->searchResults_images()
);
$runner = new \ItWorks\StageRunner('');
$runner->run($nodes);
