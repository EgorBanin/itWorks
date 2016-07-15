<?php

namespace ItWorks;

/**
 * Состояние системы -- узел графа состояний
 */
abstaract class State {

	private $id;

	private $description;

	private $test;
	
	public function __construct($id, $description) {
		$this->id = $id;
		$this->description = $description;
	}

	public function getId() {
		return $this->id;
	}

	public function setTest(callable $test) {
		$this->test = $test;
	}

	public function test() {
		//
	}

}