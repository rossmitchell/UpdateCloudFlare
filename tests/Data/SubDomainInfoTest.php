<?php
declare(strict_types = 1);
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

namespace RossMitchell\UpdateCloudFlare\Tests\Data;

use RossMitchell\UpdateCloudFlare\Data\IpType;
use RossMitchell\UpdateCloudFlare\Data\SubDomainInfo;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class SubDomainInfoTest
 * @testdox RossMitchell\UpdateCloudFlare\Data\SubDomainInfo
 * @package RossMitchell\UpdateCloudFlare\Tests\Data
 */
class SubDomainInfoTest extends AbstractTestClass
{
    /**
     * @test
     */
    public function canGetTheIpAddress()
    {
        $ipAddress = '1.2.3.4';
        $class = $this->getClass();
        $class->setIpAddress($ipAddress);

        $this->assertEquals($ipAddress, $class->getIpAddress());
    }

    /**
     * @test
     */
    public function canGetTheSubDomain()
    {
        $subDomain = 'www';
        $class = $this->getClass();
        $class->setSubDomain($subDomain);

        $this->assertEquals($subDomain, $class->getSubDomain());
    }

    /**
     * @test
     */
    public function canGetTheIpType()
    {
        $ipType = $this->getIpType();
        $class = $this->getClass();
        $class->setIpType($ipType);

        $this->assertEquals(IpType::IP_V4, $class->getIpType());
    }

    /**
     * @test
     */
    public function canGetTheSubDomainId()
    {
        $subDomainId = '1234';
        $class = $this->getClass();
        $class->setSubDomainId($subDomainId);

        $this->assertEquals($subDomainId, $class->getSubDomainId());
    }

    /**
     * @test
     */
    public function canGetTheZoneId()
    {
        $zoneId = '4567';
        $class = $this->getClass();
        $class->setZoneId($zoneId);

        $this->assertEquals($zoneId, $class->getZoneId());
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfIpAddressIsNotSet()
    {
        $class = $this->getClass();
        $this->expectException(LogicException::class);
        $class->getIpAddress();
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfIpTypeIsNotSet()
    {
        $class = $this->getClass();
        $this->expectException(LogicException::class);
        $class->getIpType();
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfSubDomainIsNotSet()
    {
        $class = $this->getClass();
        $this->expectException(LogicException::class);
        $class->getSubDomain();
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfSubDomainIdIsNotSet()
    {
        $class = $this->getClass();
        $this->expectException(LogicException::class);
        $class->getSubDomainId();
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfZoneIdIsNotSet()
    {
        $class = $this->getClass();
        $this->expectException(LogicException::class);
        $class->getZoneId();
    }

    /**
     * @return SubDomainInfo
     */
    private function getClass(): SubDomainInfo
    {
        return new SubDomainInfo();
    }

    /**
     * @param string $ipType
     *
     * @return IpType
     */
    private function getIpType(string $ipType = IpType::IP_V4): IpType
    {
        $type = new IpType();
        $type->setType($ipType);

        return $type;
    }
}
