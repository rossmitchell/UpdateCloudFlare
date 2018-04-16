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
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class IpTypeTest
 * @testdox RossMitchell\UpdateCloudFlare\Data\IpType
 * @package RossMitchell\UpdateCloudFlare\Tests\Data
 */
class IpTypeTest extends AbstractTestClass
{

    /**
     * @test
     */
    public function canSetIpv4Type(): void
    {
        $ip4  = IpType::IP_V4;
        $type = $this->getClass($ip4);
        $this->assertEquals($ip4, $type->getType());
    }

    /**
     * @test
     */
    public function canSetIPv6Type(): void
    {
        $ip6  = IpType::IP_V6;
        $type = $this->getClass($ip6);
        $this->assertEquals($ip6, $type->getType());
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfAnUnknownTypeIsSet(): void
    {
        $this->expectException(LogicException::class);
        $unknownType = 'Unknown';
        $this->getClass($unknownType);
    }

    /**
     * @param string $type
     *
     * @return IpType
     */
    private function getClass(string $type): IpType
    {
        return new IpType($type);
    }
}
