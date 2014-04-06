<?php

use ondrs\Vehico\Api\BaseApi;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';


class BaseApiTest extends \Tester\TestCase
{

    /** @var BaseApi */
    private $baseApi;


    function setUp()
    {
        $this->baseApi = new BaseApi(TEMP_DIR);

        $username = 'vehico';
        $password = 'testtest';

        $this->baseApi->setCredentials($username, $password);
    }


    function tearDown()
    {

    }


    function testSignIn()
    {
        $response = $this->baseApi->signIn();
        Assert::equal(TRUE, $response->success);
    }



    function testSignOut()
    {
        $response = $this->baseApi->signOut();
        Assert::equal(TRUE, $response->success);
    }


}

id(new BaseApiTest)->run();
