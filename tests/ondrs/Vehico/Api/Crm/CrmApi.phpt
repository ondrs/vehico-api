<?php

use ondrs\Vehico\Api\BaseApi;
use Tester\Assert;

require_once __DIR__ . '/../../../../bootstrap.php';


class CrmApiTest extends \Tester\TestCase
{

    /** @var \ondrs\Vehico\Api\Crm\CrmApi */
    private $crmApi;

    /** @var array  */
    private $tags = [];

    /** @var array  */
    private $sellers = [];

    /** @var int */
    private $sourceId;

    /** @var int */
    private $customerId;

    /** @var int */
    private $caseId;


    function setUp()
    {
        /*
        $apiKey = 'kpdfbrqlw1zuqe5v2ba3uuhqhm30bhmjib7cdbk4q0o49u5qzyxpxp5ip4l3k8go7fk5uspd0z8nqcqoix2s3zbejwg6tn65xm8ctu5cmo24jzs801rsch09t6mmie6pdd95gm4qbpjpnifur5b1h5zgq4b09ts8akl6yd1nxlgeq1ownaf7e3swean1nxbgf9qknsitl6rlohedt7p0v4ld0fjfn54abe19g5cglubi9jbrgaahf53luhienyy';
        $this->crmApi = new \ondrs\Vehico\Api\Crm\CrmApi(TEMP_DIR, $apiKey, 'https://localhost/vehico/vehico-server/www/api');
        */

        $apiKey = 'iicnm5wrrj13110ldalyixmr2d030hhmzcqsxp6ot28wa87z78tbv76e17f08d1jq5s1pbz91ad1t36jk8mk4vy7dt4x3en3l45hyhrji240c0piqf0f1nmyb98jm1n0e9whhroip9wxzewhl35ueqd98rkmzxxrhtfg65i6lbaa1v2jyxdqyd3kbwpu6wavo59zaviihi2h2fleaf93jsjl86oy34refsq58qgc2pr7kwawkei2lolhwgvm6tm';
        $this->crmApi = new \ondrs\Vehico\Api\Crm\CrmApi(TEMP_DIR, $apiKey, 'https://test.vehico.cz/api');

    }


    function testGetTags()
    {
        $tags = $this->crmApi->getTags();

        Assert::true(TRUE);
    }


    function testGetSellers()
    {
        $sellers = $this->crmApi->getSellers();
        $this->sellers = [];
        foreach($sellers->data as $t) {
            $this->sellers[] = $t->id;
        }

        Assert::true(TRUE);
    }


    function testGetSources()
    {
        $sources = $this->crmApi->getSources();

        foreach($sources->data as $t) {
            $this->sourceId = $t->id;
        }

        Assert::true(TRUE);
    }



    function testCreateCase()
    {
        $customer = new \ondrs\Vehico\Api\Crm\Entity\CustomerEntity;
        $customer->name = 'Pepa';
        $customer->surname = 'Tester';
        $customer->email = 'pepa@tester.cz';
        $customer->telephone = 798456123;
        $customer->countries_id = 'CZ';
        $customer->type = \ondrs\Vehico\Api\Crm\Entity\CustomerEntity::TYPE_INDIVIDUAL;

        $case = new \ondrs\Vehico\Api\Crm\Entity\CaseEntity;

        $case->customer = $customer->toArray();

        $case->brands[] = 'Škoda';
        $case->models[] = 'Superb';
        $case->models[] = 'Octavia';
        $case->keywords[] = 'hnědá';
        $case->keywords[] = 'kombi';
        $case->name = 'TEST: Chce koupit Škoda Superb nebo Octavia';
        $case->text = '...text... +ěščřžýáíé';

        $case->tags = $this->tags;
        $case->followers = $this->sellers;
        $case->source = 'testovací zdroj';

        $response = $this->crmApi->saveCase($case);

        $this->caseId = $response->data->id;
        $this->customerId = $response->data->customers_id;

        Assert::true(TRUE);
    }


    function testGetCase()
    {
        $response = $this->crmApi->getCase($this->caseId);
        Assert::true($response->success);
    }


    function testGetCustomer()
    {
        $response = $this->crmApi->getCustomer($this->customerId);
        Assert::true($response->success);
    }


    function testDeleteCase()
    {
        $response = $this->crmApi->deleteCase($this->caseId);
        Assert::true($response->success);
    }


    function testDeleteCustomer()
    {
        $response = $this->crmApi->deleteCustomer($this->customerId);
        Assert::true($response->success);
    }



}

id(new CrmApiTest)->run();
