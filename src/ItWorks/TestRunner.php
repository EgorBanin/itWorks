<?php

namespace ItWorks;

class TestRunner {
	
	private $baseDir;

	public function __construct($baseDir) {
		$this->baseDir = $baseDir;
	}

	public function run($nodes, $shared = []) {
		reset($nodes);
		while (list($nodeName) = current($nodes)) {
			list($edgeName, $params) = next($nodes);
			if ($edgeName) {
				$node = include $this->baseDir.'/'.$nodeName.'.php';
				$node->edge($edgeName, array_merge($shared, $params));
			}
		}
	}

}