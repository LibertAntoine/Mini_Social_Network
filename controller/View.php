<?php 

namespace controller;

class View {

	protected $message;

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($message) {
		$this->message = $message;
	}
}