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

namespace RossMitchell\UpdateCloudFlare\Factories\Requests;

use RossMitchell\UpdateCloudFlare\Data\SubDomainInfo;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Requests\UpdateDnsRecords;

class UpdateDnsRecordFactory
{
    /**
     * @var ConfigInterface
     */
    private $config;
    /**
     * @var HeadersInterface
     */
    private $headers;

    /**
     * UpdateDnsRecordFactory constructor.
     *
     * @param ConfigInterface  $config
     * @param HeadersInterface $headers
     */
    public function __construct(
        ConfigInterface $config,
        HeadersInterface $headers
    ) {

        $this->config  = $config;
        $this->headers = $headers;
    }

    /**
     * @param SubDomainInfo $subDomainInfo
     *
     * @return UpdateDnsRecords
     */
    public function create(SubDomainInfo $subDomainInfo): UpdateDnsRecords
    {
        return new UpdateDnsRecords($this->config, $this->headers, $subDomainInfo);
    }
}
