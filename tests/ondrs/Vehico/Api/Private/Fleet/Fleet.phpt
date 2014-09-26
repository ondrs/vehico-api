<?php

use Tester\Assert;

require_once __DIR__ . '/../../../../../bootstrap.php';


class FleetTest extends \Tester\TestCase
{

    /** @var \ondrs\Vehico\Api\Fleet\Fleet */
    private $fleetApi;


    function setUp()
    {

        /*
        $apiKey = 'kpdfbrqlw1zuqe5v2ba3uuhqhm30bhmjib7cdbk4q0o49u5qzyxpxp5ip4l3k8go7fk5uspd0z8nqcqoix2s3zbejwg6tn65xm8ctu5cmo24jzs801rsch09t6mmie6pdd95gm4qbpjpnifur5b1h5zgq4b09ts8akl6yd1nxlgeq1ownaf7e3swean1nxbgf9qknsitl6rlohedt7p0v4ld0fjfn54abe19g5cglubi9jbrgaahf53luhienyy';
        $this->fleetApi = new \ondrs\Vehico\Api\Fleet\FleetApi(TEMP_DIR, $apiKey, 'https://localhost/vehico/vehico-server/www/api');
        */

        $apiKey = 'iicnm5wrrj13110ldalyixmr2d030hhmzcqsxp6ot28wa87z78tbv76e17f08d1jq5s1pbz91ad1t36jk8mk4vy7dt4x3en3l45hyhrji240c0piqf0f1nmyb98jm1n0e9whhroip9wxzewhl35ueqd98rkmzxxrhtfg65i6lbaa1v2jyxdqyd3kbwpu6wavo59zaviihi2h2fleaf93jsjl86oy34refsq58qgc2pr7kwawkei2lolhwgvm6tm';
        $this->fleetApi = new \ondrs\Vehico\Api\Fleet\Fleet(TEMP_DIR, $apiKey, 'https://test.vehico.cz/api');

    }


    function testGetVehicles()
    {
        $vehicles = $this->fleetApi->getVehicles();
        Assert::type('object', $vehicles);
    }



}

id(new FleetTest)->run();
