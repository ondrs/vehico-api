<?php

namespace ondrs\Vehico\Api\PrivateApi\Fleet;

use GuzzleHttp\Client;
use Nette\Caching\Cache;
use Nette\Caching\IStorage;
use ondrs\Vehico\Api\PublicApi\ListsApi;

class ApiFactory
{

	/** @var string */
	const API_URL = 'https://www.vehico.cz/api';


	/**
	 * @param string $tempDir
	 * @param string $apiKey
	 * @param string $url
	 * @param IStorage $storage
	 */
	public function __construct($tempDir, $apiKey, $url = self::API_URL, IStorage $storage)
	{
		$this->tempDir = $tempDir;
		$this->apiKey = $apiKey;
		$this->cache = new Cache($storage, __CLASS__);

		$this->curlClient = new Client([
			'base_url' => $url,
		]);
	}


	/**
	 * @return FleetApi
	 */
	public function createFleetApi()
	{
		return new FleetApi($this->tempDir, $this->apiKey, $this->curlClient, $this->cache);
	}


	/**
	 * @return ListsApi
	 */
	public function createListsApi()
	{
		return new ListsApi($this->tempDir, $this->apiKey, $this->curlClient, $this->cache);
	}
	
}
