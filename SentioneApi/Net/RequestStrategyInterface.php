<?php

namespace SentioneApi\Net;

interface RequestStrategyInterface {
	/**
	 * Makes API request
	 * 
	 * @param string $action
	 * @param array $params
	 * @param array $metadata (athentication info: username, password)
	 * 
	 * @return Response
	 */
	public function doApiRequest($action, array $params, array $metadata);
}
