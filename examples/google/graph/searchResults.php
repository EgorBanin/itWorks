<?php

$node = new ItWorks\Node('searchResults', 'Результаты поиска');
$node->addEdge('searchResults/images', function($wd) {
	sleep(2);
	$imgButton = $wd->findElement(WebDriverBy::cssSelector('#hdtb-msb a[href*="tbm=isch"]'));
	$imgButton->click();
});

return $node;