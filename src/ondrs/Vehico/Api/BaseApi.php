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
    protected $url = 'http://git.vehico.cz:8082/api';

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;


    /**
     * @param string $tempDir
     * @param string|null $url
     */
    public function __construct($tempDir, $url = NULL)
    {
        $this->tempDir = $tempDir;

        $this->curl = new \Curl;

        $this->curl->options['ssl_verifyPeer'] = FALSE;
        $this->curl->options['cookieSession'] = TRUE;

        $this->curl->headers['Accept'] = 'application/json';

        $this->curl->cookie_file = $this->tempDir . '/vehico.cookie';


        if($url !== NULL) {
            $this->url = $url;
        }
    }


    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function setCredentials($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        return $this;
    }


    /**
     * @return \stdClass
     * @throws JsonException
     */
    public function signIn()
    {
        $response = $this->request('POST', $this->url . '/public/sign/in', array(
            'username' => $this->username,
            'password' => $this->password,
        ));

        return $this->getResponseBody($response);
    }


    /**
     * @return \stdClass
     * @throws JsonException
     */
    public function signOut()
    {
        $response = $this->request('POST', $this->url . '/public/sign/out', array(''));
        return $this->getResponseBody($response);
    }


    /**
     * @param string $method
     * @param string $url
     * @param array|null $args
     * @return \CurlResponse
     * @throws CurlException
     */
    protected function request($method, $url, $args = NULL)
    {
        try {
            $method = strtoupper($method);
            return $this->curl->$method($url, $args);
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
