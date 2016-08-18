<?php

namespace ItWorks;

class Node {

	private $id;

	private $description;

	private $edges = [];

	private $test;
	
	public function __construct($id, $description) {
		$this->id = $id;
		$this->description = $description;
	}

	public function getId() {
		return $this->id;
	}

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