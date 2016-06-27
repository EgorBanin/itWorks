<?php

$step = new \ItWorks\Step(
	'Проверяем открытие вкладки Видео',
	function($wd) {
		$oldTitle = $wd->getTitle();
		$elements = $wd->findElements(WebDriverBy::cssSelector('#hdtb-msb a[href*="tbm=vid"]'));
		$this->assert(
			'На странице присутствет кнопка Картинки (#hdtb-msb a[href*="tbm=vid"])',
			! empty($elements)
		);
		$imgButton = reset($elements);
		$imgButton->click();
		$this->assert(
			'На странице присутствуют результаты поиска картинок (#ires)',
			! empty($wd->findElements(WebDriverBy::cssSelector('#ires')))
		);

		return $wd;
	}
);

return $step;