<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 22.2.14
 * Time: 11:11
 */

namespace ondrs\Vehico\Api\Fleet;

use ondrs\Vehico\Api\BaseApi;

class Fleet extends BaseApi
{

    const
        TAG_ACTIVE = 'active',
        TAG_DRAFT = 'draft',
        TAG_ARCHIVED = 'archived',
        TAG_SOLD = 'sold';


    /**
     * @param string $tag
     * @param null $star
     * @param int $page
     * @param null $sort
     * @param null $filter
     * @return \stdClass
     * @throws \ondrs\Vehico\Api\CurlException
     * @throws \ondrs\Vehico\Api\JsonException
     */
    public function getVehicles($tag = self::TAG_ACTIVE, $star = NULL, $page = 1, $sort = NULL, $filter = NULL)
    {
        $vars = [
            'tag' => $tag,
            'page' => $page,
        ];

        if ($star !== NULL) {
            $vars['tag'] = $tag;
        }

        if ($sort !== NULL) {
            $vars['sort'] = $sort;
        }

        if ($filter !== NULL) {
            $vars['filter'] = $filter;
        }

        $response = $this->request('GET', $this->url . '/private/fleet/vehicles', $vars);
        return $this->getResponseBody($response);
    }


    /**
     * @param $id
     * @return \stdClass
     * @throws \ondrs\Vehico\Api\CurlException
     * @throws \ondrs\Vehico\Api\JsonException
     */
    public function getVehicle($id)
    {
        $response = $this->request('GET', $this->url . '/private/fleet/vehicles/' . $id);
        return $this->getResponseBody($response);
    }


}
