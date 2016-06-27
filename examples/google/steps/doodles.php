<?php

$step = new \ItWorks\Step(
	'Проверяем открытие дудлов',
	function($wd) {
		$oldTitle = $wd->getTitle();
		$elements = $wd->findElements(WebDriverBy::cssSelector('input[value="Мне повезёт!"]'));
		$this->assert(
			'На странице присутствет кнопка Мне повезёт! (input[value="Мне повезёт!"])',
			! empty($elements)
		);
		$button = reset($elements);
		$button->click();
		$wd->wait(10, 1000)->until(function($wd) use ($oldTitle) {
			// ждём пока не изменится заголовок
			return $wd->getTitle() != $oldTitle;
		});
		$text = 'Дудлы';
		$this->assert(
			"Заголовок содержит $text",
			strpos($wd->getTitle(), $text) !== false
		);

		return $wd;
	}
);

return $step;