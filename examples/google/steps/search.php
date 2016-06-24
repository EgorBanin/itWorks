<?php

$step = new \ItWorks\Step(
	'Проверем работу поиска',
	function($wd) {
		$elements = $wd->findElements(WebDriverBy::cssSelector('input#lst-ib'));
		$this->assert(
			'На странице присутствет строка поиска (input#lst-ib)',
			! empty($elements)
		);
		$searchInput = reset($elements);
		$searchInput->click();
		$q = 'test';
		$wd->getKeyboard()->sendKeys($q);
		$wd->->getKeyboard()->pressKey(WebDriverKeys::ENTER);
		$this->assert(
			"Заголовок содержит $q",
			strpos($wd->getTitle(), $q) !== false
		);
		$this->assert(
			'На странице присутствуют результаты поиска (.srg)',
			! empty($wd->findElements(WebDriverBy::cssSelector('.srg')))
		);

		return $wd;
	}
);

return $step;