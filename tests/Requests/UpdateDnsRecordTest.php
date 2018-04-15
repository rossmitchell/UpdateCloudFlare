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

namespace RossMitchell\UpdateCloudFlare\Tests\Requests;

use RossMitchell\UpdateCloudFlare\Data\IpType;
use RossMitchell\UpdateCloudFlare\Factories\Data\SubDomainInfoFactory;
use RossMitchell\UpdateCloudFlare\Factories\Requests\UpdateDnsRecordFactory;

class UpdateDnsRecordTest extends AbstractRequest
{
    /**
     * @Inject
     * @var UpdateDnsRecordFactory
     */
    private $factory;
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
     * @return mixed
     */
    public function getRequest()
    {
        $subDomain = $this->subDomainFactory->create($this->subDomain, $this->type);
        $subDomain->setSubDomainId($this->subDomainId);
        $subDomain->setIpAddress($this->ipAddress);
        $subDomain->setZoneId($this->zoneId);

        return $this->factory->create($subDomain);
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'X-Auth-Email: test@example.com',
            'X-Auth-Key: 123456789',
            'Content-Type: application/json',
        ];
    }

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return 'PUT';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'type'    => $this->type,
            'name'    => $this->subDomain.'.example.com',
            'content' => $this->ipAddress,
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        $zoneId      = $this->zoneId;
        $subDomainId = $this->subDomainId;

        return "https://api.cloudflare.com/client/v4/zones/${zoneId}/dns_records/${subDomainId}";
    }
}
