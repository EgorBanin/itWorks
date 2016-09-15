<?php

namespace ItWorks;

/**
 * Узел графа состояний тестируемой системы
 */
class Node {

	private $id;

	private $description;

	private $validator;

	private $edges = [];

	private $test;
	
	public function __construct($id, $description) {
		$this->id = $id;
		$this->description = $description;
	}

	public function getId() {
		return $this->id;
	}

	public function setValidator($func) {
		$this->validator = $func;
	}

	public function isValid() {
		$isValid = $this->validator?
			call_user_func_array($this->validator, func_get_arg(0))
			: true;

		return $isValid;
	}

	/**
	 * Добавить ребро -- функцию перехода к другому узлу
	 * Функция должа заключать в себе только необходимые для перехода действия.
	 * @param string $id
	 * @param callable $func
	 */
	public function addEdge($id, $func) {
		$this->edges[$id] = $func;
	}

	public function edge($id, $params) {
		call_user_func_array($this->edges[$id], $params);
	}

	public function setTest(callable $test) {
		$this->test = $test;
	}

	public function test() {
		//
	}

}