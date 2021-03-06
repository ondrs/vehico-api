<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 22.2.14
 * Time: 11:11
 */

namespace ondrs\Vehico\Api;


use Hampel\Json\Json;
use Hampel\Json\JsonException as HampelJsonException;


class BaseApi
{

    /** @var string */
    protected $tempDir;

    /** @var \Curl */
    protected $curl;

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $url;

    /** @var string */
    const API_URL = 'https://www.vehico.cz/api';



    /**
     * @param string $tempDir
     * @param string|null $url
     */
    public function __construct($tempDir, $apiKey, $url = NULL)
    {
        $this->tempDir = $tempDir;
        $this->apiKey = $apiKey;

        $this->curl = new \Curl;


        $this->curl->options['SSL_VERIFYHOST'] = FALSE;
        $this->curl->options['ssl_verifyPeer'] = FALSE;
        $this->curl->headers['Accept'] = 'application/json';
        $this->curl->headers['X-VEHICO-API-KEY'] = $apiKey;

        $this->url = $url ? $url : self::API_URL;
    }


    /**
     * @param $method
     * @param $url
     * @param null $args
     * @return \CurlResponse
     * @throws CurlException
     */
    protected function request($method, $url, $args = NULL)
    {
        try {
            $method = strtoupper($method);

            /** @var \CurlResponse $response */
            $response = $this->curl->$method($url, $args);

            if ($response->headers['Status-Code'] >= 300 && $response->headers['Status-Code'] < 400) {

                return $method === 'GET'
                    ? $this->request($method, $response->headers['Location'])
                    : $this->request($method, $response->headers['Location'], $args);
            }

            if($response->headers['Status-Code'] >= 400) {
                throw new CurlException($response->headers['Status'], $response->headers['Status-Code']);
            }

            return $response;
        } catch(\CurlException $e) {
            throw new CurlException($e->getMessage(), $e->getCode());
        }
    }



    /**
     * @param \CurlResponse $response
     * @return \stdClass
     * @throws JsonException
     */
    protected function getResponseBody(\CurlResponse $response)
    {
        try {
            return Json::decode($response->body);
        } catch(HampelJsonException $e) {
            throw new JsonException($e->getMessage(), $e->getCode());
        }
    }


} 
