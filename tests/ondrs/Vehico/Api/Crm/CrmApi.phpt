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
        $this->crmApi = new \ondrs\Vehico\Api\Crm\CrmApi(TEMP_DIR);

        $username = 'vehico';
        $password = 'testtest';

        $this->crmApi->setCredentials($username, $password);
    }


    function tearDown()
    {
        //$this->crmApi->signOut();
    }


    function testGetTags()
    {
        // catch curl exception if user is not logged in
        // if not log him in
        try {
            $tags = $this->crmApi->getTags();
        } catch(\ondrs\Vehico\Api\CurlException $e) {
            if($e->getCode() == 401) {
                $this->crmApi->signIn();
                $tags = $this->crmApi->getTags();
            } else {
                throw $e;
            }
        }

        $this->tags = [];
        foreach($tags->data as $t) {
            $this->tags[] = $t->id;
        }

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
        $case->branches_id = 1;

        $case->customer = $customer->toArray();

        $case->brands = 'Škoda';
        $case->models = 'Superb;Octavia';
        $case->keywords = 'hnědá;kombi';
        $case->name = 'TEST: Chce koupit Škoda Superb nebo Octavia';
        $case->text = '...text... +ěščřžýáíé';

        $case->tags = $this->tags;
        $case->followers = $this->sellers;
        $case->crm_sources_id = $this->sourceId;

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
