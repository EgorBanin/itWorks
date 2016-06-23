<?php

$tests = TestBuilder::build(__DIR__.'/steps', [
	'openIndexPage.php' => [
		'search.php' => [
			'search/openImagesTab.php' => [
				'search/images/selectImage.php',
			],
			'search/openVideoTab.php',
		],
		'doodles.php',
	],
]);
$runner = new TestRunner();
$results = $runner->run($tests);

var_export($results->toArray());