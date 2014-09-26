<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 6.4.14
 * Time: 13:49
 */

namespace ondrs\Vehico\Api\PrivateApi\Crm\Entity;


use ondrs\Vehico\BaseEntity;

class CaseEntity extends BaseEntity
{
    public $id;
    public $vehicles_id;
    public $name;
    public $text;
    public $starred = FALSE;
    public $status = 'open';
    public $km_min = 0;
    public $km_max = 100000;
    public $price_min = 0;
    public $price_max = 1000000;

    public $brands = [];
    public $models = [];
    public $keywords = [];

    public $crm_sources_id;
    public $source;

    /** @var array */
    public $tags = [];
    public $followers = [];

    /** @var array from CustomerEntity */
    public $customer;

    // API user NULL id
    public $users_id = NULL;
} 
