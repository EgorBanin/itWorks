<?php

$step = new \ItWorks\Step(
	'Проверяем работу поиска',
	function($wd) {
		$oldTitle = $wd->getTitle();
		$elements = $wd->findElements(WebDriverBy::cssSelector('input#lst-ib'));
		$this->assert(
			'На странице присутствет строка поиска (input#lst-ib)',
			! empty($elements)
		);
		$searchInput = reset($elements);
		$q = 'test';
		$searchInput->sendKeys($q);
		$wd->getKeyboard()->pressKey(WebDriverKeys::ENTER);
		$wd->wait(10, 1000)->until(function($wd) use ($oldTitle) {
			// ждём пока не изменится заголовок
			return $wd->getTitle() != $oldTitle;
		});
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