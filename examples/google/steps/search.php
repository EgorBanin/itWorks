<?php

$step = new \ItWorks\Step(
	'Проверем работу поиска',
	function($wd) {
		$elements = $wd->findElements(WebDriverBy::cssSelector('input#lst-ib'));
		$this->assert(
			! empty($elements)),
			'На странице присутствет строка поиска (input#lst-ib)'
		);
		$searchInput = reset($elements);
		$searchInput->click();
		$q = 'test';
		$wd->getKeyboard()->sendKeys($q);
		$wd->->getKeyboard()->pressKey(WebDriverKeys::ENTER);
		$this->assert(
			strpos($wd->getTitle(), $q) !== false,
			"Заголовок содержит $q"
		);
		$this->assert(
			! empty($wd->findElements(WebDriverBy::cssSelector('.srg'))),
			'На странице присутствуют результаты поиска (.srg)'
		);

		return $wd;
	}
);

return $step;