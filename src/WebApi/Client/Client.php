<?php

namespace DataStorageComponent\WebApi\Client;

class Client
{
	protected $conf = array();

	public function configure(array $conf)
	{
		$this->conf = $conf;
		return $this;
	}

	public function execute($action, array $params = array())
	{
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $this->getUrl(),
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => http_build_query(array(
				'action' => $action,
				'params' => $params
			), '', '&')
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		return $resp;
	}

	protected function getUrl()
	{
		$url = $this->conf['url'];
		if (!$url) {
			throw new \ErrorException('No url received');
		}
		return $url;
	}
}
