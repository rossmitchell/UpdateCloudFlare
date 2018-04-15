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

namespace RossMitchell\UpdateCloudFlare\Responses;

use RossMitchell\UpdateCloudFlare\Abstracts\CloudFlareResponse;
use RossMitchell\UpdateCloudFlare\Factories\Responses\ErrorFactory;
use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\DnsRecordFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class DnsRecords
 * @package RossMitchell\UpdateCloudFlare\Responses
 */
class DnsRecords extends CloudFlareResponse
{
    /**
     * @var DnsRecord[]
     */
    private $result;
    /**
     * @var DnsRecordFactory
     */
    private $dnsRecordFactory;

    /**
     * DnsRecords constructor.
     *
     * @param DnsRecordFactory $dnsRecordFactory
     * @param ErrorFactory     $errorFactory
     * @param \stdClass        $rawResult
     *
     * @throws \RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException
     */
    public function __construct(DnsRecordFactory $dnsRecordFactory, ErrorFactory $errorFactory, \stdClass $rawResult)
    {
        $this->dnsRecordFactory = $dnsRecordFactory;
        parent::__construct($rawResult, $errorFactory);
    }

    /**
     * @return DnsRecord[]
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     *
     * @throws LogicException
     */
    public function setResult($result)
    {
        $results = [];
        $result  = (array)$result;

        foreach ($result as $data) {
            $results[] = $this->dnsRecordFactory->create($data);
        }
        $this->result = $results;
    }
}
