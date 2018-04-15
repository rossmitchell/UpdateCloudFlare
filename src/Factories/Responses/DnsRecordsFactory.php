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

namespace RossMitchell\UpdateCloudFlare\Factories\Responses;

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\DnsRecordFactory;
use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\ListZoneResultsFactory;
use RossMitchell\UpdateCloudFlare\Responses\DnsRecords;
use RossMitchell\UpdateCloudFlare\Responses\ListZones;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class DnsRecordsFactory
 * @package RossMitchell\UpdateCloudFlare\Factories\Responses
 */
class DnsRecordsFactory
{
    /**
     * @var DnsRecordFactory
     */
    private $dnsRecordFactory;
    /**
     * @var ErrorFactory
     */
    private $errorFactory;

    /**
     * ListZoneFactory constructor.
     *
     * @param DnsRecordFactory $dnsRecordFactory
     * @param ErrorFactory     $errorFactory
     */
    public function __construct(DnsRecordFactory $dnsRecordFactory, ErrorFactory $errorFactory)
    {
        $this->dnsRecordFactory = $dnsRecordFactory;
        $this->errorFactory     = $errorFactory;
    }

    /**
     * @param \stdClass $data
     *
     * @return DnsRecords
     * @throws CloudFlareException
     */
    public function create(\stdClass $data): DnsRecords
    {
        return new DnsRecords($this->dnsRecordFactory, $this->errorFactory, $data);
    }
}
