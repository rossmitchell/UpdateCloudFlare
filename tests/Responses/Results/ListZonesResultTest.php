<?php
/**
 *
 * Copyright (C) 2018  Ross Mitchell
 *
 * This file is part of RossMitchell/UpdateCloudFlare.
 *
 * RossMitchell/UpdateCloudFlare is free software: you can redistribute
 * it and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results;

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\ListZoneResultsFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult;
use RossMitchell\UpdateCloudFlare\Responses\Results\Owner;
use RossMitchell\UpdateCloudFlare\Responses\Results\Plan;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ListZonesResultTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results
 */
class ListZonesResultTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var ListZoneResultsFactory
     */
    private $factory;

    /**
     * @test
     */
    public function canBeCreatedUsingTheFactory()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(ListZonesResult::class, $class);
    }

    /**
     * @test
     */
    public function canReturnTheId()
    {
        $class = $this->createClass();
        $this->assertEquals('023e105f4ecef8ad9ca31a8372d0c353', $class->getId());
    }

    /**
     * @test
     */
    public function canReturnTheName()
    {
        $class = $this->createClass();
        $this->assertEquals('example.com', $class->getName());
    }

    /**
     * @test
     */
    public function canReturnTheDevelopmentMode()
    {
        $class = $this->createClass();
        $this->assertEquals(7200, $class->getDevelopmentMode());
    }

    /**
     * @test
     */
    public function canReturnTheOriginalNameServers()
    {
        $class       = $this->createClass();
        $expected    = [
            "ns1.originaldnshost.com",
            "ns2.originaldnshost.com",
        ];
        $nameServers = $class->getOriginalNameServers();
        $this->assertInternalType('array', $nameServers);
        $this->assertEquals($expected, $nameServers);
    }

    /**
     * @test
     */
    public function canReturnTheOriginalRegistrar()
    {
        $class = $this->createClass();
        $this->assertEquals('GoDaddy', $class->getOriginalRegistrar());
    }

    /**
     * @test
     */
    public function canReturnTheOriginalDnsHost()
    {
        $class = $this->createClass();
        $this->assertEquals('NameCheap', $class->getOriginalDnsHost());
    }

    /**
     * @test
     */
    public function canReturnTheCreatedOn()
    {
        $class = $this->createClass();
        $this->assertEquals('2014-01-01T05:20:00.12345Z', $class->getCreatedOn());
    }

    /**
     * @test
     */
    public function canReturnTheModifiedOn()
    {
        $class = $this->createClass();
        $this->assertEquals('2014-01-01T05:20:00.12345Z', $class->getModifiedOn());
    }

    /**
     * @test
     */
    public function canReturnTheOwner()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Owner::class, $class->getOwner());
    }

    /**
     * @test
     */
    public function canReturnThePermissions()
    {
        $class       = $this->createClass();
        $expected    = [
            "#zone:read",
            "#zone:edit",
        ];
        $permissions = $class->getPermissions();
        $this->assertInternalType('array', $permissions);
        $this->assertEquals($expected, $permissions);
    }

    /**
     * @test
     */
    public function canReturnThePlan()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Plan::class, $class->getPlan());
    }

    /**
     * @test
     */
    public function canReturnThePlanPending()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Plan::class, $class->getPlanPending());
    }

    /**
     * @test
     */
    public function canReturnTheStatus()
    {
        $class = $this->createClass();
        $this->assertEquals('active', $class->getStatus());
    }

    /**
     * @test
     */
    public function canReturnIsPaused()
    {
        $class = $this->createClass();
        $this->assertFalse($class->isPaused());
    }

    /**
     * @test
     */
    public function canReturnTheType()
    {
        $class = $this->createClass();
        $this->assertEquals('full', $class->getType());
    }

    /**
     * @test
     */
    public function canReturnTheNameServers()
    {
        $class       = $this->createClass();
        $expected    = [
            "tony.ns.cloudflare.com",
            "woz.ns.cloudflare.com",
        ];
        $nameServers = $class->getNameServers();
        $this->assertInternalType('array', $nameServers);
        $this->assertEquals($expected, $nameServers);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheIdIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->id);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheNameIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->name);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheDevelopmentModeIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->development_mode);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOriginalNameServersIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->original_name_servers);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOriginalRegistrarIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->original_registrar);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOriginalDnsHostIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->original_dnshost);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheCreatedOnIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->created_on);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheModifiedOnIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->modified_on);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOwnerIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->owner);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePermissionsIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->permissions);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePlanIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->plan);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePlanPendingIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->plan_pending);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheStatusIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->status);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfIsPausedIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->paused);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheTypeIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->type);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheNameServersIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->name_servers);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    private function createClass(\stdClass $json = null)
    {
        if ($json === null) {
            $json = $this->getExampleJson();
        }

        return $this->factory->create($json);
    }

    /**
     * Taken from here https://api.cloudflare.com/#zone-list-zones
     * @return \stdClass
     */
    private function getExampleJson(): \stdClass
    {
        $data = <<<JSON
{
    "id": "023e105f4ecef8ad9ca31a8372d0c353",
    "name": "example.com",
    "development_mode": 7200,
    "original_name_servers": [
        "ns1.originaldnshost.com",
        "ns2.originaldnshost.com"
    ],
    "original_registrar": "GoDaddy",
    "original_dnshost": "NameCheap",
    "created_on": "2014-01-01T05:20:00.12345Z",
    "modified_on": "2014-01-01T05:20:00.12345Z",
    "owner": {
        "id": "7c5dae5552338874e5053f2534d2767a",
        "email": "user@example.com",
        "owner_type": "user"
    },
    "permissions": [
        "#zone:read",
        "#zone:edit"
    ],
    "plan": {
        "id": "e592fd9519420ba7405e1307bff33214",
        "name": "Pro Plan",
        "price": 20,
        "currency": "USD",
        "frequency": "monthly",
        "legacy_id": "pro",
        "is_subscribed": true,
        "can_subscribe": true
    },
    "plan_pending": {
        "id": "e592fd9519420ba7405e1307bff33214",
        "name": "Pro Plan",
        "price": 20,
        "currency": "USD",
        "frequency": "monthly",
        "legacy_id": "pro",
        "is_subscribed": true,
        "can_subscribe": true
    },
    "status": "active",
    "paused": false,
    "type": "full",
    "name_servers": [
        "tony.ns.cloudflare.com",
        "woz.ns.cloudflare.com"
    ]
}
JSON;

        return \json_decode($data);
    }
}
