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

namespace RossMitchell\UpdateCloudFlare\Tests\Requests;

use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;
use RossMitchell\UpdateCloudFlare\Requests\ZoneInfo;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class ZoneInfoTest
 * @testdox RossMitchell\UpdateCloudFlare\Requests\ZoneInfo
 * @package RossMitchell\UpdateCloudFlare\Tests\Requests
 */
class ZoneInfoTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var ZoneInfo
     */
    private $zoneInfo;

    /**
     * @test
     */
    public function theClassImplementsTheCorrectInterface()
    {
        $this->assertInstanceOf(RequestInterface::class, $this->zoneInfo);
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectHeadersArray()
    {
        $headers  = $this->zoneInfo->getHeaders();
        $expected = [
            'X-Auth-Email: test@example.com',
            'X-Auth-Key: 123456789',
            'Content-Type: application/json',
        ];
        $this->assertInternalType('array', $headers);
        $this->assertEquals($expected, $headers);
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectRequestType()
    {
        $this->assertEquals('GET', $this->zoneInfo->getRequestType());
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectFields()
    {
        $fields = $this->zoneInfo->getFields();
        $this->assertInternalType('array', $fields);
        $this->assertEmpty($fields);
    }

    /**
     * @test
     */
    public function theClassReturnsTheCorrectUrl()
    {
        $expectedUrl = 'https://api.cloudflare.com/client/v4/zones?name=example.com';
        $this->assertEquals($expectedUrl, $this->zoneInfo->getUrl());
    }
}
