<?php
namespace SentioneApi;

class ApiResponse {
	
	/**
	 * @var string
	 */
	private $requestedAction;
	
	/**
	 * @var array
	 */
	private $requestedParams;
	
	/**
	 * @var array
	 */
	private $data;
	
	/**
	 * @var array
	 */
	private $metadata;
	
	/**
	 * 
	 * @param string $requestedAction
	 * @param array $requestedParams
	 * @param array $data
	 * @param array $metadata
	 * @return \SentioneApi\ApiResponse
	 */
	public static function build($requestedAction, $requestedParams, $data, $metadata) {
		$o = new self();
		
		$o->requestedAction = $requestedAction;
		$o->requestedParams = $requestedParams;
		$o->data = $data;
		$o->metadata = $metadata;
		
		return $o;
	}
	
	/**
	 * @return string $requestedAction
	 */
	public function getRequestedAction() {
		return $this->requestedAction;
	}

	/**
	 * @return array $requestedParams
	 */
	public function getRequestedParams() {
		return $this->requestedParams;
	}

	/**
	 * @return array $data
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @return array $metadata
	 */
	public function getMetadata() {
		return $this->metadata;
	}
}
