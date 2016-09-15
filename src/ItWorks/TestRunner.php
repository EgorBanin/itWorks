<?php

namespace ItWorks;

function _include() {
	return include func_get_arg(0);
}

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
				$nodeFile = $this->baseDir.'/'.$nodeName.'.php';
				if ( ! is_readable($nodeFile)) {
					throw new Exception(
						"Невозможно прочитать файл $nodeFile",
						Exception::CODE_FILE_NOT_FOUND
					);
				}

				$node = _include($nodeFile);
				if ( ! ($node instanceof Node)) {
					throw new Exception(
						"Подключеный файл $nodeFile вернул не объект класса "
							.Node::class,
						Exception::CODE_INVALID_CLASS
					);
				}

				if ($node->isValid($shared)) {
					$node->edge($edgeName, array_merge($shared, $params));
				} else {
					throw new Exception(
						'Узел '.$node->getId().' невалидный',
						Exception::CODE_INVALID_NODE
					);
				}
			}
		}
	}

}