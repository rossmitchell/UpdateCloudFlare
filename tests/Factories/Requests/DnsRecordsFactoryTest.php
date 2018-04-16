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

namespace RossMitchell\UpdateCloudFlare\Tests\Factories\Requests;

use RossMitchell\UpdateCloudFlare\Data\IpType;
use RossMitchell\UpdateCloudFlare\Factories\Requests\DnsRecordsFactory;
use RossMitchell\UpdateCloudFlare\Requests\DnsRecords;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class DnsRecordsFactoryTest
 * @testdox RossMitchell\UpdateCloudFlare\Factories\Requests\DnsRecordsFactory
 * @package RossMitchell\UpdateCloudFlare\Tests\Factories\Requests
 */
class DnsRecordsFactoryTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var DnsRecordsFactory
     */
    private $factory;

    /**
     * @test
     */
    public function canCreateTheClassUsingTheFactory(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(DnsRecords::class, $class);
    }

    /**
     * @test
     */
    public function itSetsTheRequiredParameters(): void
    {
        $class = $this->createClass();
        $this->assertEquals('www', $class->getSubDomainInfo()
                                         ->getSubDomain());
        $this->assertEquals(IpType::IP_V4, $class->getSubDomainInfo()
                                                 ->getIpType());
        $this->assertEquals('12345', $class->getSubDomainInfo()
                                           ->getZoneId());
    }

    /**
     * @param string $subDomain
     * @param string $type
     * @param string $zoneId
     *
     * @return DnsRecords
     */
    private function createClass(
        string $subDomain = 'www',
        string $type = IpType::IP_V4,
        string $zoneId = '12345'
    ): DnsRecords {
        return $this->factory->create($subDomain, $type, $zoneId);
    }
}
