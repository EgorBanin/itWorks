<?php

namespace ItWorks;

class StageRunner {
	
	private $baseDir;

	public function __construct($baseDir) {
		$this->baseDir = $baseDir;
	}

	public function run($nodes) {
		reset($nodes);
		while (list($nodeName) = current($nodes)) {
			list($edgeName, $params) = next($nodes);
		}
	}

}