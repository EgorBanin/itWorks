<?php

$step = new \ItWorks\Step(
	'Проверяем что открывается главная страница',
	function() {
	$wd = Env::webDriver();
	$wd->get('https://google.com');
	$this->assert(
		strpos($wd->getTitle(), 'Google') !== false,
		'Заголовок содержит Google'
	);
	$this->assert(
		! empty($wd->findElements(WebDriverBy::cssSelector('#hplogo'))),
		'На странице присутствет логотип (#hplogo)'
	);

	return $wd;
});

return $step;