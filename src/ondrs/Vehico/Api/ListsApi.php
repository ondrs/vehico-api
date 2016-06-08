<?php

namespace ondrs\Vehico\Api\PublicApi;

use ondrs\Vehico\Api\AbstractApi;

class ListsApi extends AbstractApi
{

    /**
     * @return \stdClass
     * @throws \ondrs\Vehico\Api\CurlException
     * @throws \ondrs\Vehico\Api\JsonException
     */
    public function getEquips()
    {
        $response = $this->request('GET', 'public/list/equips');
        
        return self::getResponseBody($response);
    }

} 
