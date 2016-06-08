<?php

namespace ondrs\Vehico\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Nette\Caching\Cache;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractApi
{

	/** @var string */
	protected $tempDir;

	/** @var string */
	private $apiKey;

	/** @var Client */
	protected $curlClient;

	/** @var Cache */
	private $cache;

	const DEFAULT_OPTIONS = [
		RequestOptions::VERIFY => FALSE,
	];


	public function __construct($tempDir, $apiKey, Client $client, Cache $cache)
	{
		$this->tempDir = $tempDir;
		$this->apiKey = $apiKey;
		$this->curlClient = $client;
		$this->cache = $cache;
	}


	/**
	 * @internal
	 * @param $method
	 * @param $url
	 * @param null $body
	 * @return ResponseInterface
	 * @throws CurlException
	 * @throws JsonException
	 */
	private function handleRequest($method, $url, $body = NULL)
	{
		$options = [
			RequestOptions::HEADERS => [
				'X-VEHICO-API-KEY' => $this->apiKey,
				'Content-Type' => 'application/json',
			],
		];

		if ($body) {
			$options[RequestOptions::BODY] = Json::encode($body);
		}

		$response = $this->curlClient->request($method, $url, self::DEFAULT_OPTIONS + $options);

		$headers = $response->getHeaders();

		// TODO: maybe remove
		if ($headers['Status-Code'][0] >= 300 && $headers['Status-Code'][0] < 400) {

			return $method === 'GET'
				? $this->handleRequest($method, $response->headers['Location'])
				: $this->handleRequest($method, $response->headers['Location'], $options);
		}

		if ($headers['Status-Code'][0] >= 400) {
			throw new CurlException($headers['Status'][0], $headers['Status-Code'][0]);
		}

		return $response;
	}
	

	/**
	 * @param $method
	 * @param $url
	 * @param null $body
	 * @return mixed|NULL
	 */
	protected function request($method, $url, $body = NULL)
	{
		$method = strtoupper($method);
		$key = md5($this->apiKey . $method . $url . serialize($body));

		return $this->cache->load($key, function (&$dependencies) use ($method, $url, $body) {
			$dependencies[Cache::EXPIRE] = '15 minutes';
			
			try {
				return $this->handleRequest($method, $url, $body);
			} catch (GuzzleException $e) {
				throw new CurlException($e);
			}
		});
	}


	/**
	 * @param ResponseInterface $response
	 * @return mixed
	 * @throws JsonException
	 */
	public static function getResponseBody(ResponseInterface $response)
	{
		try {
			return Json::decode((string)$response->getBody());
		} catch (JsonException $e) {
			throw new JsonException($e->getMessage(), $e->getCode());
		}
	}

} 
