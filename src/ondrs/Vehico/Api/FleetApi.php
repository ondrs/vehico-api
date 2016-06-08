<?php

namespace ondrs\Vehico\Api\PrivateApi\Fleet;

use ondrs\Vehico\Api\AbstractApi;

class FleetApi extends AbstractApi
{

	const TAG_ACTIVE = 'active';
	const TAG_DRAFT = 'draft';
	const TAG_ARCHIVED = 'archived';
	const TAG_SOLD = 'sold';


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
	public function findVehicles($tag = self::TAG_ACTIVE, $star = NULL, $page = 1, $sort = NULL, $filter = NULL)
	{
		$vars = [
			'tag' => $tag,
			'page' => $page,
		];

		if ($star !== NULL) {
			$vars['star'] = $star;
		}

		if ($sort !== NULL) {
			$vars['sort'] = $sort;
		}

		if ($filter !== NULL) {
			$vars['filter'] = $filter;
		}

		$response = $this->request('GET', 'private/fleet/vehicles', $vars);

		return self::getResponseBody($response);
	}


	/**
	 * @param int $id
	 * @return \stdClass
	 * @throws \ondrs\Vehico\Api\CurlException
	 * @throws \ondrs\Vehico\Api\JsonException
	 */
	public function getVehicle($id)
	{
		$response = $this->request('GET', 'private/fleet/vehicles/' . $id);

		return self::getResponseBody($response);
	}

}
