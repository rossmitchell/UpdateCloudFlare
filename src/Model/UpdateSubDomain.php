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

namespace RossMitchell\UpdateCloudFlare\Model;

use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Model\Requests\GetIpAddress;
use RossMitchell\UpdateCloudFlare\Model\Requests\GetSubDomainInfo;
use RossMitchell\UpdateCloudFlare\Model\Requests\UpdateDnsRecord;
use Symfony\Component\Console\Exception\LogicException;

class UpdateSubDomain
{
    /**
     * @var GetIpAddress
     */
    private $ipAddress;
    /**
     * @var GetSubDomainInfo
     */
    private $subDomainInfo;
    /**
     * @var UpdateDnsRecord
     */
    private $updateDnsRecord;
    /**
     * @var string
     */
    private $newIpAddress;
    /**
     * @var string
     */
    private $subDomain;
    /**
     * @var Config
     */
    private $config;

    /**
     * UpdateSubDomain constructor.
     *
     * @param Config           $config
     * @param GetIpAddress     $ipAddress
     * @param GetSubDomainInfo $subDomainInfo
     * @param UpdateDnsRecord  $updateDnsRecord
     */
    public function __construct(
        Config $config,
        GetIpAddress $ipAddress,
        GetSubDomainInfo $subDomainInfo,
        UpdateDnsRecord $updateDnsRecord
    ) {
        $this->config          = $config;
        $this->ipAddress       = $ipAddress;
        $this->subDomainInfo   = $subDomainInfo;
        $this->updateDnsRecord = $updateDnsRecord;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        if ($this->newIpAddress === null) {
            $this->setIpAddress($this->ipAddress->getIpAddress());
        }

        return $this->newIpAddress;
    }

    /**
     * @param string $ipAddress
     *
     * @return $this
     */
    public function setIpAddress(string $ipAddress): UpdateSubDomain
    {
        $this->newIpAddress = $ipAddress;
        $this->updateDnsRecord->setNewIpAddress($ipAddress);

        return $this;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getSubDomain(): string
    {
        if ($this->subDomain === null) {
            throw new LogicException('You must set the sub domain');
        }

        return $this->subDomain;
    }

    /**
     * @param string $subDomain
     *
     * @return $this
     */
    public function setSubDomain(string $subDomain): UpdateSubDomain
    {
        $this->subDomain = $subDomain;
        $this->updateDnsRecord->setSubDomain($subDomain);
        $this->subDomainInfo->setSubDomain($subDomain);

        return $this;
    }

    /**
     * @return string
     * @throws CloudFlareException
     */
    public function updateSubDomain(): string
    {
        $newIpAddress     = $this->getIpAddress();
        $currentIpAddress = $this->subDomainInfo->getSubDomainIpAddress();
        if ($newIpAddress !== $currentIpAddress) {
            return $this->updateDnsRecord->changeIpAddress();
        }

        $subDomain = $this->getFullDomain();

        return "IP Address for $subDomain did not need to be updated";
    }

    private function getFullDomain(): string
    {
        return $this->getSubDomain().'.'.$this->config->getBaseUrl();
    }
}
