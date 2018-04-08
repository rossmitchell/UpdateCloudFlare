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

namespace RossMitchell\UpdateCloudFlare\Tests\Model\Requests;

use RossMitchell\UpdateCloudFlare\Model\Requests\CurrentIpAddress;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Curl;

class CurrentIpTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var CurrentIpAddress
     */
    private $currentIp;

    /**
     * @Inject
     * @var Curl
     */
    private $curl;

    /**
     * @test
     */
    public function canReturnTheCurrentIpAddress()
    {
        $expectedIpAddress = '1.2.3.4';
        $this->curl->setResponse($expectedIpAddress);
        $actualIpAddress = $this->currentIp->getCurrentIpAddress();

        $this->assertEquals($expectedIpAddress, $actualIpAddress);
    }
}
