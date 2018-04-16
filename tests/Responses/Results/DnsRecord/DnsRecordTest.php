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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results\DnsRecord;

use RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord;

/**
 * Class DnsRecordTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results\DnsRecord
 */
class DnsRecordTest extends AbstractClass
{
    /**
     * @test
     */
    public function canBeCreatedUsingTheFactory(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(DnsRecord::class, $class);
    }

    /**
     * @test
     */
    public function canReturnTheId(): void
    {
        $class      = $this->createClass();
        $expectedId = '372e67954025e0ba6aaa6d586b9e0b59';
        $this->assertEquals($expectedId, $class->getId());
    }

    /**
     * @test
     */
    public function canReturnTheType(): void
    {
        $class    = $this->createClass();
        $expected = 'A';
        $this->assertEquals($expected, $class->getType());
    }

    /**
     * @test
     */
    public function canReturnTheName(): void
    {
        $class    = $this->createClass();
        $expected = 'example.com';
        $this->assertEquals($expected, $class->getName());
    }

    /**
     * @test
     */
    public function canReturnTheContent(): void
    {
        $class    = $this->createClass();
        $expected = '1.2.3.4';
        $this->assertEquals($expected, $class->getContent());
    }

    /**
     * @test
     */
    public function canReturnTheProxiable(): void
    {
        $class = $this->createClass();
        $this->assertTrue($class->isProxiable());
    }

    /**
     * @test
     */
    public function canReturnTheProxied(): void
    {
        $class = $this->createClass();
        $this->assertFalse($class->isProxied());
    }

    /**
     * @test
     */
    public function canReturnTheTtl(): void
    {
        $class    = $this->createClass();
        $expected = '120';
        $this->assertEquals($expected, $class->getTtl());
    }

    /**
     * @test
     */
    public function canReturnTheLocked(): void
    {
        $class = $this->createClass();
        $this->assertFalse($class->isLocked());
    }

    /**
     * @test
     */
    public function canReturnTheZoneId(): void
    {
        $class    = $this->createClass();
        $expected = '023e105f4ecef8ad9ca31a8372d0c353';
        $this->assertEquals($expected, $class->getZoneId());
    }

    /**
     * @test
     */
    public function canReturnTheZoneName(): void
    {
        $class    = $this->createClass();
        $expected = 'example.com';
        $this->assertEquals($expected, $class->getZoneName());
    }

    /**
     * @test
     */
    public function canReturnTheCreatedOn(): void
    {
        $class    = $this->createClass();
        $expected = '2014-01-01T05:20:00.12345Z';
        $this->assertEquals($expected, $class->getCreatedOn());
    }

    /**
     * @test
     */
    public function canReturnTheModifiedOn(): void
    {
        $class    = $this->createClass();
        $expected = '2014-01-01T05:20:00.12345Z';
        $this->assertEquals($expected, $class->getModifiedOn());
    }

    /**
     * @test
     */
    public function canReturnTheData(): void
    {
        $class = $this->createClass();
        $this->assertNull($class->getData());
    }
}
