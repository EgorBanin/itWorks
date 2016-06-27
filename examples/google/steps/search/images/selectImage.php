<?php

$step = new \ItWorks\Step(
	'Проверяем открытие картинки',
	function($wd) {
		$oldTitle = $wd->getTitle();
		$locator = '#search a[href*="imgres"]';
		$elements = $wd->findElements(WebDriverBy::cssSelector($locator));
		$this->assert(
			"На странице присутствуют картинки ($locator)",
			! empty($elements)
		);
		$img = reset($elements);
		$img->click();
		$this->assert(
			'На странице присутствует блок с увеличеной картинкой (#irc_bg)',
			! empty($wd->findElements(WebDriverBy::cssSelector('#irc_bg')))
		);

		return $wd;
	}
);

return $step;