<?php

namespace SentioneApi\Net\RequestStrategy;

use SentioneApi\Net\Response;

use SentioneApi\Net\RequestStrategyInterface;
use SentioneApi\ApiException;

class Curl implements RequestStrategyInterface {

	/**
	 * (non-PHPdoc)
	 * @see SentioneApi\Net.RequestStrategyInterface::doApiRequest()
	 */
	public function doApiRequest($action, array $params, array $metadata) {
		if(!isset($metadata['host']))
			throw new ApiException('Missing host');
		
		$host = $metadata['host'];
		
		$c = curl_init($host);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		
		if(!isset($metadata['authentication_strategy']))
			throw new ApiException('Missing authentication strategy');
		
		if ($metadata['authentication_strategy'] == 'digest') {
			if(!isset($metadata['authentication_username']))
				throw new ApiException('Missing authentication username');
			
			if(!isset($metadata['authentication_password']))
				throw new ApiException('Missing authentication password');
			
			curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($c, CURLOPT_USERPWD, $metadata['authentication_username'] . ":" . $metadata['authentication_password']);
		}
		else
			throw new ApiException(sprintf('Unknown authentication strategy: %s', $metadata['authentication_strategy']));
		
		$postfields = http_build_query(array(
			'request' => json_encode(array(
				'action' => $action,
				'params' => $params,
			)),
		));
		
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
		
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
// 		curl_setopt($c, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($c, CURLOPT_UNRESTRICTED_AUTH, 1);
		
		$body = curl_exec($c);
		$info = curl_getinfo($c);
		curl_close($c);
		
		$code = $info['code'];
		
		return new Response($code, $body);
	}
}
