<?php

$node = new ItWorks\Node('homePage', 'Главная страница');
$node->addEdge('searchResults', function($wd, $q = 'test') {
	$searchInput = $wd->findElement(WebDriverBy::cssSelector('input#lst-ib'));
	$searchInput->sendKeys($q);
	$wd->getKeyboard()->pressKey(WebDriverKeys::ENTER);
});

return $node;