<?php

namespace ItWorks;

class Path {

	private $points = [];

	public function addPoint($stateId, array $params) {
		$this->points[] = [$stateId, $params];
	}

	public static function __callStatic($name, array $arguments) {
		$self = new self();
		$self->addPoint($name, $params);

		return $self;
	}

	public function __call($name, array $arguments) {
		$this->addPoint($name, $arguments);

		return $this;
	}

	public function eachInterval($func) {
		reset($this->points);
		while (list($a, $aParams) = each($this->points)) {
			$bPoint = current($this->points);
			if ($bPoint) {
				list($b, $bParams) = $bPoint;
				call_user_func($func, $a, $aParams, $b, $bParams);
			}
		}
	}

}