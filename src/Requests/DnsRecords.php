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

namespace RossMitchell\UpdateCloudFlare\Requests;

use RossMitchell\UpdateCloudFlare\Data\SubDomainInfo;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class DnsRecords
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class DnsRecords implements RequestInterface
{
    /**
     * @var HeadersInterface
     */
    private $headers;
    /**
     * @var ConfigInterface
     */
    private $config;
    /**
     * @var SubDomainInfo
     */
    private $subDomainInfo;

    /**
     * DnsRecords constructor.
     *
     * @param ConfigInterface  $config
     * @param HeadersInterface $headers
     */
    public function __construct(ConfigInterface $config, HeadersInterface $headers)
    {
        $this->config  = $config;
        $this->headers = $headers;
    }

    /**
     * If headers need to be sent through then they can be returned with this method. If not return an empty array
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers->getHeadersArray();
    }

    /**
     * They type of request that is going to be made
     *
     * @return string
     */
    public function getRequestType(): string
    {
        return 'GET';
    }

    /**
     * If the request needs data to be sent though return it here. If not return an empty array
     *
     * @return array
     */
    public function getFields(): array
    {
        return [];
    }

    /**
     * Return the URL that the request should be made to
     *
     * @return string
     * @throws \RuntimeException
     * @throws LogicException
     */
    public function getUrl(): string
    {
        $baseUrl       = $this->config->getApiUrl();
        $subDomainInfo = $this->getSubDomainInfo();
        $zoneID        = $subDomainInfo->getZoneId();
        $type          = $subDomainInfo->getIpType();
        $subDomain     = $subDomainInfo->getSubDomain();
        $domain        = $this->config->getBaseUrl();
        $fullDomain    = "${subDomain}.${domain}";

        return "${baseUrl}zones/${zoneID}/dns_records?type=$type&name=$fullDomain";
    }

    /**
     * @return SubDomainInfo
     * @throws LogicException
     */
    public function getSubDomainInfo(): SubDomainInfo
    {
        if ($this->subDomainInfo === null) {
            throw new LogicException('You must set the sub domain info object');
        }

        return $this->subDomainInfo;
    }

    /**
     * @param SubDomainInfo $subDomainInfo
     *
     * @return DnsRecords
     */
    public function setSubDomainInfo(SubDomainInfo $subDomainInfo): DnsRecords
    {
        $this->subDomainInfo = $subDomainInfo;

        return $this;
    }
}
