<?php

$graph = GraphBuilder::build('');
$walker = new Walker($graph);
$walker->walk(
	Path::homePage()
		->searchResults('foo')
		->images()
);