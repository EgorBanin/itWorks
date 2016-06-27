<?php

$step = new \ItWorks\Step(
	'Проверяем что открывается главная страница',
	function($wd) {
		$wd->get('https://google.com');
		$this->assert(
			'Заголовок содержит Google',
			strpos($wd->getTitle(), 'Google') !== false
		);
		$this->assert(
			'На странице присутствет логотип (#hplogo)',
			! empty($wd->findElements(WebDriverBy::cssSelector('#hplogo')))
		);

		return $wd;
	}
);

return $step;