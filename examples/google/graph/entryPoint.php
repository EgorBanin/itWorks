<?php

$node = new ItWorks\Node('entryPoint', 'Точка входа');
$node->addEdge('homePage', function($wd) {
	$wd->get('https://google.com');
});

return $node;