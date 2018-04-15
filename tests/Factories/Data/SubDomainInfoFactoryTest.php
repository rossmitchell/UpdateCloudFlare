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

namespace RossMitchell\UpdateCloudFlare\Tests\Factories\Data;


use RossMitchell\UpdateCloudFlare\Data\IpType;
use RossMitchell\UpdateCloudFlare\Data\SubDomainInfo;
use RossMitchell\UpdateCloudFlare\Factories\Data\SubDomainInfoFactory;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class SubDomainInfoFactoryTest
 * @testdox RossMitchell\UpdateCloudFlare\Factories\Data\SubDomainInfoFactory
 * @package RossMitchell\UpdateCloudFlare\Tests\Factories\Data
 */
class SubDomainInfoFactoryTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var SubDomainInfoFactory
     */
    private $factory;

    /**
     * @test
     */
    public function itCanCreateTheClass()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(SubDomainInfo::class, $class);
    }

    /**
     * @test
     */
    public function itCanCreateAClassWhenGetIsCalled()
    {
        $class = $this->getClass();
        $this->assertInstanceOf(SubDomainInfo::class, $class);
    }

    /**
     * @test
     */
    public function callingGetWhenTheClassHasAlreadyBeenCreatedWillReturnIt()
    {
        $createdClass = $this->createClass();
        $gotClass     = $this->getClass();
        $this->assertEquals($createdClass, $gotClass);
    }

    /**
     * @test
     */
    public function callingGetWhenTheClassHasNotAlreadyBeenCreatedWillReturnADifferentClass()
    {
        $createdClass = $this->createClass();
        $gotClass     = $this->getClass('example');
        $this->assertNotEquals($createdClass, $gotClass);
    }

    /**
     * @param string $subDomain
     * @param string $type
     *
     * @return SubDomainInfo
     */
    private function createClass(string $subDomain = 'www', string $type = IpType::IP_V4): SubDomainInfo
    {
        return $this->factory->create($subDomain, $type);
    }

    /**
     * @param string $subDomain
     * @param string $type
     *
     * @return SubDomainInfo
     */
    private function getClass(string $subDomain = 'www', string $type = IpType::IP_V4): SubDomainInfo
    {
        return $this->factory->get($subDomain, $type);
    }
}
