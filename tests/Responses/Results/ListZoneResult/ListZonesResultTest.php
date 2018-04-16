<?php declare(strict_types = 1);
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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results\ListZoneResult;

use RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult;
use RossMitchell\UpdateCloudFlare\Responses\Results\Owner;
use RossMitchell\UpdateCloudFlare\Responses\Results\Plan;

/**
 * Class ListZonesResultTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results
 */
class ListZonesResultTest extends AbstractClass
{
    /**
     * @test
     */
    public function canBeCreatedUsingTheFactory(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(ListZonesResult::class, $class);
    }

    /**
     * @test
     */
    public function canReturnTheId(): void
    {
        $class = $this->createClass();
        $this->assertEquals('023e105f4ecef8ad9ca31a8372d0c353', $class->getId());
    }

    /**
     * @test
     */
    public function canReturnTheName(): void
    {
        $class = $this->createClass();
        $this->assertEquals('example.com', $class->getName());
    }

    /**
     * @test
     */
    public function canReturnTheDevelopmentMode(): void
    {
        $class = $this->createClass();
        $this->assertEquals(7200, $class->getDevelopmentMode());
    }

    /**
     * @test
     */
    public function canReturnTheOriginalNameServers(): void
    {
        $class       = $this->createClass();
        $expected    = [
            'ns1.originaldnshost.com',
            'ns2.originaldnshost.com',
        ];
        $nameServers = $class->getOriginalNameServers();
        $this->assertInternalType('array', $nameServers);
        $this->assertEquals($expected, $nameServers);
    }

    /**
     * @test
     */
    public function canReturnTheOriginalRegistrar(): void
    {
        $class = $this->createClass();
        $this->assertEquals('GoDaddy', $class->getOriginalRegistrar());
    }

    /**
     * @test
     */
    public function canReturnTheOriginalDnsHost(): void
    {
        $class = $this->createClass();
        $this->assertEquals('NameCheap', $class->getOriginalDnsHost());
    }

    /**
     * @test
     */
    public function canReturnTheCreatedOn(): void
    {
        $class = $this->createClass();
        $this->assertEquals('2014-01-01T05:20:00.12345Z', $class->getCreatedOn());
    }

    /**
     * @test
     */
    public function canReturnTheModifiedOn(): void
    {
        $class = $this->createClass();
        $this->assertEquals('2014-01-01T05:20:00.12345Z', $class->getModifiedOn());
    }

    /**
     * @test
     */
    public function canReturnTheOwner(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Owner::class, $class->getOwner());
    }

    /**
     * @test
     */
    public function canReturnThePermissions(): void
    {
        $class       = $this->createClass();
        $expected    = [
            '#zone:read',
            '#zone:edit',
        ];
        $permissions = $class->getPermissions();
        $this->assertInternalType('array', $permissions);
        $this->assertEquals($expected, $permissions);
    }

    /**
     * @test
     */
    public function canReturnThePlan(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Plan::class, $class->getPlan());
    }

    /**
     * @test
     */
    public function canReturnThePlanPending(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Plan::class, $class->getPlanPending());
    }

    /**
     * @test
     */
    public function canReturnTheStatus(): void
    {
        $class = $this->createClass();
        $this->assertEquals('active', $class->getStatus());
    }

    /**
     * @test
     */
    public function canReturnIsPaused(): void
    {
        $class = $this->createClass();
        $this->assertFalse($class->isPaused());
    }

    /**
     * @test
     */
    public function canReturnTheType(): void
    {
        $class = $this->createClass();
        $this->assertEquals('full', $class->getType());
    }

    /**
     * @test
     */
    public function canReturnTheNameServers(): void
    {
        $class       = $this->createClass();
        $expected    = [
            'tony.ns.cloudflare.com',
            'woz.ns.cloudflare.com',
        ];
        $nameServers = $class->getNameServers();
        $this->assertInternalType('array', $nameServers);
        $this->assertEquals($expected, $nameServers);
    }
}
