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

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Model\Requests\GetZoneId;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Curl;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers\ListZonesResponse;

/**
 * Class GetZoneIdTest
 * @testdox RossMitchell\UpdateCloudFlare\Model\Requests\GetZoneId
 * @package RossMitchell\UpdateCloudFlare\Tests\Model\Requests
 */
class GetZoneIdTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var GetZoneId
     */
    private $getZoneId;

    /**
     * @Inject
     * @var Curl
     */
    private $curl;

    /**
     * @Inject
     * @var ListZonesResponse
     */
    private $responseHelper;

    /**
     * @test
     */
    public function canReturnTheExpectedZoneId()
    {
        $mockResponse = $this->getJson();
        $this->curl->setResponse($mockResponse);
        $id = $this->getZoneId->getZoneId();
        $this->assertEquals('023e105f4ecef8ad9ca31a8372d0c353', $id);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThereIsAnError()
    {
        $mockResponse = $this->getJson('false');
        $this->curl->setResponse($mockResponse);
        $this->expectException(CloudFlareException::class);
        $this->getZoneId->getZoneId();
    }

    /**
     * @param string $success
     *
     * @return string
     */
    private function getJson(string $success = 'true'): string
    {
        return $this->responseHelper->getFullJson($success);
    }
}
