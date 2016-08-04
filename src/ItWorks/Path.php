<?php

namespace ItWorks;

class Path {

	private $points = [];

	public function addPoint($stateId, array $params) {
		$this->points[] = [$stateId, $params];
	}

	public static function __callStatic($name, $arguments) {
		$self = new self();
		$self->addPoint($name, $arguments);

		return $self;
	}

	public function __call($name, $arguments) {
		$this->addPoint($name, $arguments);

		return $this;
	}

	public function eachInterval($func) {
		reset($this->points);
		while (list(, $aPoint) = each($this->points)) {
			$bPoint = current($this->points);
			if ($bPoint) {
				list($a, $aParams) = $aPoint;
				list($b, $bParams) = $bPoint;
				call_user_func($func, $a, $aParams, $b, $bParams);
			}
		}
	}

}