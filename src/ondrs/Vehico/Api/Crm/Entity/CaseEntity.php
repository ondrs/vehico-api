<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 6.4.14
 * Time: 13:49
 */

namespace ondrs\Vehico\Api\Crm\Entity;


use ondrs\Vehico\BaseEntity;

class CaseEntity extends BaseEntity
{
    public $id;
    public $crm_sources_id;
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

    /** @var array */
    public $tags = [];
    public $followers = [];

    /** @var array from CustomerEntity */
    public $customer;

} 
