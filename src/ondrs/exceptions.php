<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 22.2.14
 * Time: 18:03
 */

namespace ondrs\Vehico\Api;


class VehicoException extends \Exception
{

}


class JsonException extends VehicoException
{

}


class CurlException extends VehicoException
{

}

