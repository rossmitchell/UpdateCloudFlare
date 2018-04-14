<?php
declare(strict_types=1);
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

namespace RossMitchell\UpdateCloudFlare\Factories\Responses\Results;

use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class DnsRecordFactory
 * @package RossMitchell\UpdateCloudFlare\Factories\Responses\Results
 */
class DnsRecordFactory
{
    const SIMPLE_FIELDS = [
        'id',
        'type',
        'name',
        'content',
        'proxiable',
        'proxied',
        'ttl',
        'locked',
        'zone_id',
        'zone_name',
        'created_on',
        'modified_on',
        'data',
    ];

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * DnsRecordFactory constructor.
     *
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @param \stdClass $data
     *
     * @return DnsRecord
     * @throws LogicException
     */
    public function create(\stdClass $data): DnsRecord
    {
        $record = new DnsRecord();
        foreach (self::SIMPLE_FIELDS as $property) {
            $this->hydrator->setProperty($record, $data, $property);
        }

        return $record;
    }
}
