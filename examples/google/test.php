<?php

require __DIR__.'/bootstrap.php';

$tb = new \ItWorks\TestBuilder();
$tests = $tb->build(__DIR__.'/steps', [
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
$runner = new \ItWorks\TestRunner();
$results = $runner->run($tests);
foreach ($results as $result) {
	echo 'Test ', $result->status, "\n";
	foreach ($result->getSteps() as $step) {
		echo "\t", $step->getDescription(), "\n";
	}
}