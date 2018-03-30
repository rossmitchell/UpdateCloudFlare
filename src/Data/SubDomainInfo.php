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

namespace RossMitchell\UpdateCloudFlare\Data;

use Symfony\Component\Console\Exception\LogicException;

/**
 * Class SubDomainInfo
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class SubDomainInfo
{
    /**
     * @var string
     */
    private $ipAddress;
    /**
     * @var string
     */
    private $subDomain;
    /**
     * @var IpType
     */
    private $ipType;
    /**
     * @var string
     */
    private $subDomainId;
    /**
     * @var string
     */
    private $zoneId;

    /**
     * @return string
     * @throws LogicException
     */
    public function getIpAddress(): string
    {
        if ($this->ipAddress === null) {
            $this->throwException('IP Address');
        }

        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress(string $ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getSubDomain(): string
    {
        if ($this->subDomain === null) {
            $this->throwException('sub domain');
        }

        return $this->subDomain;
    }

    /**
     * @param string $subDomain
     */
    public function setSubDomain(string $subDomain)
    {
        $this->subDomain = $subDomain;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getIpType(): string
    {
        if ($this->ipType === null) {
            $this->throwException('IP Type');
        }

        return $this->ipType->getType();
    }

    /**
     * @param IpType $ipType
     */
    public function setIpType(IpType $ipType)
    {
        $this->ipType = $ipType;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getSubDomainId(): string
    {
        if ($this->subDomainId === null) {
            $this->throwException('sub domain ID');
        }
        return $this->subDomainId;
    }

    /**
     * @param string $subDomainId
     */
    public function setSubDomainId(string $subDomainId)
    {
        $this->subDomainId = $subDomainId;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getZoneId(): string
    {
        if ($this->zoneId === null) {
            $this->throwException('Zone ID');
        }
        return $this->zoneId;
    }

    /**
     * @param string $zoneId
     */
    public function setZoneId(string $zoneId)
    {
        $this->zoneId = $zoneId;
    }

    /**
     * @param string $missingProperty
     */
    private function throwException(string $missingProperty)
    {
        throw new LogicException("You must set the $missingProperty");
    }
}
