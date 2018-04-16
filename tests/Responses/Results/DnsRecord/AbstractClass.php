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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results\DnsRecord;

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\DnsRecordFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers\DnsRecordsResponse;

/**
 * Class AbstractClass
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results\DnsRecord
 */
abstract class AbstractClass extends AbstractTestClass
{
    /**
     * @Inject
     * @var DnsRecordFactory
     */
    private $factory;

    /**
     * @Inject
     * @var DnsRecordsResponse
     */
    private $responseHelper;

    /**
     * @param \stdClass|null $json
     *
     * @return DnsRecord
     */
    public function createClass(\stdClass $json = null): DnsRecord
    {
        if ($json === null) {
            $json = $this->getJson();
        }

        return $this->factory->create($json);
    }

    /**
     * @return \stdClass
     */
    public function getJson(): \stdClass
    {
        return \json_decode($this->responseHelper->getResultJson());
    }
}
