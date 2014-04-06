<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 6.4.14
 * Time: 14:21
 */

namespace ondrs\Vehico\Api\Crm\Entity;


use ondrs\Vehico\BaseEntity;

class CustomerEntity extends BaseEntity
{

    const
        TYPE_INDIVIDUAL = 'individual',
        TYPE_BUSINESS = 'business',
        TYPE_SOLE_PROPRIETOR = 'sole_proprietor';

    public $id;
    public $name;
    public $surname;
    public $company;
    public $email;
    public $telephone;
    public $street;
    public $city;
    public $postal;
    public $id_no;
    public $countries_id;
    public $branches_id;
    public $type;
} 
