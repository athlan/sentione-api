<?php

namespace SentioneApi;

class Client
{
	/**
	 * @var string
	 */
	private $apiUrl = 'http://api.sentione.com/api';
	
	/**
	 * @var string
	 */
	private $username;
	
	/**
	 * @var string
	 */
	private $password;
	
	/**
	 * @var \SentioneApi\Net\RequestStrategyInterface
	 */
	private $requestStrategy;
	
	/**
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($username, $password) {
		$this->setUsername($username);
		$this->setPassword($password);
	}
	
	public function apiCall($action, array $params) {
		if (null === $this->requestStrategy) {
			$this->setRequestStrategy(new \SentioneApi\Net\RequestStrategy\Curl());
		}
		
		$metadata = array(
			'host' => $this->apiUrl,
			
			'authentication_username' => $this->username,
			'authentication_password' => $this->password,
			'authentication_strategy' => 'digest',
		);
		
		/* @var $response \SentioneApi\Net\Response */
		$response = $this->requestStrategy->doApiRequest($action, $params, $metadata);
		
		if(200 == $response->getResponseCode()) {
			$metadata = array();
			return ApiResponse::build($action, $params, $response->getResponseBody(), $metadata);
		}
		
		switch ($response->getResponseCode()) {
			case 401:
				throw new ApiException("Bad credentials", 401);
			
			default:
				throw new ApiException("Unknown error", $response->getResponseCode());
		}
	}
	
	/**
	 * @return string $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return string $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return \SentioneApi\Net\RequestStrategyInterface $requestStrategy
	 */
	public function getRequestStrategy() {
		return $this->requestStrategy;
	}

	/**
	 * @param \SentioneApi\Net\RequestStrategyInterface $requestStrategy
	 */
	public function setRequestStrategy($requestStrategy) {
		$this->requestStrategy = $requestStrategy;
	}
}
