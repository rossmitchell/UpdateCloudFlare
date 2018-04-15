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

namespace RossMitchell\UpdateCloudFlare\Model\Requests;

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Factories\Responses\DnsRecordsFactory;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Requests\DnsRecords;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class GetSubDomainInfo
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class GetSubDomainInfo
{
    /**
     * @var string
     */
    private $subDomainId;
    /**
     * @var string
     */
    private $subDomainIpAddress;
    /**
     * @var CurlInterface
     */
    private $curl;
    /**
     * @var DnsRecordsFactory
     */
    private $dnsRecordsFactory;

    /**
     * GetSubDomainInfo constructor.
     *
     * @param CurlInterface     $curl
     * @param DnsRecordsFactory $dnsRecordsFactory
     */
    public function __construct(CurlInterface $curl, DnsRecordsFactory $dnsRecordsFactory)
    {
        $this->curl              = $curl;
        $this->dnsRecordsFactory = $dnsRecordsFactory;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getSubDomainId(): string
    {
        if ($this->subDomainId === null) {
            throw new LogicException('You must collect the information before getting the sub domain ID');
        }

        return $this->subDomainId;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getSubDomainIpAddress(): string
    {
        if ($this->subDomainIpAddress === null) {
            throw new LogicException('You must collect the information before getting the IP Address');
        }

        return $this->subDomainIpAddress;
    }

    /**
     * @param DnsRecords $request
     *
     * @throws CloudFlareException
     */
    public function collectionInformation(DnsRecords $request)
    {
        $rawResult                = \json_decode($this->curl->makeRequest($request));
        $result                   = $this->dnsRecordsFactory->create($rawResult);
        $details                  = $result->getResult()[0];
        $this->subDomainId        = $details->getId();
        $this->subDomainIpAddress = $details->getContent();
    }
}
