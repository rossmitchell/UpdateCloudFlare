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
use RossMitchell\UpdateCloudFlare\Factories\Data\SubDomainInfoFactory;
use RossMitchell\UpdateCloudFlare\Factories\Requests\UpdateDnsRecordFactory;
use RossMitchell\UpdateCloudFlare\Model\Requests\UpdateDnsRecord;
use RossMitchell\UpdateCloudFlare\Requests\UpdateDnsRecords;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Curl;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers\UpdateDnsRecordsResponse;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class UpdateDnsRecordTest
 * @testdox RossMitchell\UpdateCloudFlare\Requests\UpdateDnsRecords
 * @package RossMitchell\UpdateCloudFlare\Tests\Model\Requests
 */
class UpdateDnsRecordTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var UpdateDnsRecord
     */
    private $updateDnsRecord;
    /**
     * @Inject
     * @var Curl
     */
    private $curl;
    /**
     * @Inject
     * @var UpdateDnsRecordsResponse
     */
    private $responseHelper;
    /**
     * @Inject
     * @var UpdateDnsRecordFactory
     */
    private $requestFactory;
    /**
     * @Inject
     * @var SubDomainInfoFactory
     */
    private $subDomainFactory;
    /**
     * @var string
     */
    private $subDomain = 'www';
    /**
     * @var string
     */
    private $subDomainId = '98765';
    /**
     * @var string
     */
    private $type = IpType::IP_V4;
    /**
     * @var string
     */
    private $zoneId = '12345';
    /**
     * @var string
     */
    private $ipAddress = '9.8.7.6';

    /**
     * @test
     */
    public function itCanUpdateTheIpAddressSuccessfully()
    {
        $response = $this->responseHelper->getFullJson();
        $this->curl->setResponse($response);
        $class   = $this->updateDnsRecord;
        $request = $this->getRequest();
        $result  = $class->changeIpAddress($request);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function itWillThrowAnExceptionIfTheChangedIpAddressIsNotWhatIsExcepted()
    {
        $this->ipAddress = '1.2.3.4';
        $response = $this->responseHelper->getFullJson();
        $this->curl->setResponse($response);
        $class   = $this->updateDnsRecord;
        $request = $this->getRequest();
        $this->expectException(LogicException::class);
        $class->changeIpAddress($request);
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
        $this->updateDnsRecord->changeIpAddress($request);
    }

    /**
     * @return UpdateDnsRecords
     */
    private function getRequest(): UpdateDnsRecords
    {
        $subDomain = $this->subDomainFactory->create($this->subDomain, $this->type);
        $subDomain->setSubDomainId($this->subDomainId);
        $subDomain->setIpAddress($this->ipAddress);
        $subDomain->setZoneId($this->zoneId);

        return $this->requestFactory->create($subDomain);
    }
}
