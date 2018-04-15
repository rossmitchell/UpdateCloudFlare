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

namespace RossMitchell\UpdateCloudFlare\Tests\Model\Requests;

use RossMitchell\UpdateCloudFlare\Data\IpType;
use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Factories\Requests\DnsRecordsFactory;
use RossMitchell\UpdateCloudFlare\Model\Requests\GetSubDomainInfo;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Curl;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers\DnsRecordsResponse;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class GetSubDomainInformationTest
 * @testdox RossMitchell\UpdateCloudFlare\Model\Requests\GetSubDomainInfo
 * @package RossMitchell\UpdateCloudFlare\Tests\Model\Requests
 */
class GetSubDomainInformationTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var GetSubDomainInfo
     */
    private $subDomainInfo;
    /**
     * @Inject
     * @var Curl
     */
    private $curl;
    /**
     * @Inject
     * @var DnsRecordsResponse
     */
    private $responseHelper;
    /**
     * @Inject
     * @var DnsRecordsFactory
     */
    private $requestFactory;

    /**
     * @test
     */
    public function itReturnsTheCorrectIpAddress()
    {
        $response = $this->responseHelper->getFullJson();
        $this->curl->setResponse($response);
        $request = $this->getRequest();
        $class   = $this->subDomainInfo;
        $class->collectionInformation($request);
        $this->assertEquals('1.2.3.4', $class->getSubDomainIpAddress());
    }

    /**
     * @test
     */
    public function itReturnsTheCorrectSubDomainId()
    {
        $response = $this->responseHelper->getFullJson();
        $this->curl->setResponse($response);
        $request = $this->getRequest();
        $class   = $this->subDomainInfo;
        $class->collectionInformation($request);
        $this->assertEquals('372e67954025e0ba6aaa6d586b9e0b59', $class->getSubDomainId());
    }

    /**
     * @test
     */
    public function itThrowsAnExceptionIfYouTryToGetTheIpAddressEarly()
    {
        $this->expectException(LogicException::class);
        $this->subDomainInfo->getSubDomainIpAddress();
    }

    /**
     * @test
     */
    public function itThrowsAnExceptionIfYouTryToGetTheIdEarly()
    {
        $this->expectException(LogicException::class);
        $this->subDomainInfo->getSubDomainId();
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThereIsAnError()
    {
        $mockResponse = $this->responseHelper->getFullJson('false');
        $this->curl->setResponse($mockResponse);
        $request = $this->getRequest();
        $this->expectException(CloudFlareException::class);
        $this->subDomainInfo->collectionInformation($request);
    }

    private function getRequest(string $subDomain = 'www', string $type = IpType::IP_V4, $zoneId = '12345')
    {
        return $this->requestFactory->create($subDomain, $type, $zoneId);
    }
}
