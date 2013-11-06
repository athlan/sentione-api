<?php

namespace SentioneApi\Net;

class Response {
	
	/**
	 * @var string
	 */
	private $responseBody;
	
	/**
	 * @var int
	 */
	private $responseCode;
	
	/**
	 * 
	 * @param int $responseCode
	 * @param string $responseBody
	 */
	public function __construct($responseCode, $responseBody) {
		$this->responseCode = $responseCode;
		$this->responseBody = $responseBody;
	}
	
	/**
	 * @return string $responseBody
	 */
	public function getResponseBody() {
		return $this->responseBody;
	}
	
	/**
	 * @param string $responseBody
	 */
	public function setResponseBody($responseBody) {
		$this->responseBody = $responseBody;
	}

	/**
	 * @param int $responseCode
	 */
	public function setResponseCode($responseCode) {
		$this->responseCode = $responseCode;
	}
	
	/**
	 * @return int $responseCode
	 */
	public function getResponseCode() {
		return $this->responseCode;
	}
	
}
