<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 22.2.14
 * Time: 11:11
 */

namespace ondrs\Vehico\Api\PublicApi;


use ondrs\Vehico\Api\BaseApi;

class Lists extends BaseApi
{

    /**
     * @return \stdClass
     * @throws \ondrs\Vehico\Api\CurlException
     * @throws \ondrs\Vehico\Api\JsonException
     */
    public function getEquips()
    {
        $response = $this->request('GET', $this->url . '/public/list/equips');
        return $this->getResponseBody($response);
    }


} 
