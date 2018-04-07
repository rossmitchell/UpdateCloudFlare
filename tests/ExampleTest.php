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

namespace RossMitchell\UpdateCloudFlare\Tests;

use RossMitchell\UpdateCloudFlare\Data\IpType;

/**
 * Class ExampleTest
 * @testdox Basic Testing Setup
 * @package RossMitchell\UpdateCloudFlare\Tests
 */
class ExampleTest extends AbstractTestClass
{

    /**
     * @Inject
     * @var IpType
     */
    private $ipType;


    public function testCanRunABasicTest()
    {
        $this->assertEquals(1, 1);
    }

    public function testCanInjectObjectsAsNeeded()
    {
        $plan = $this->ipType;
        $this->assertInstanceOf(IpType::class, $plan);
        $testName = "AAAA";
        $plan->setType($testName);
        $this->assertEquals($testName, $plan->getType());

    }
}
