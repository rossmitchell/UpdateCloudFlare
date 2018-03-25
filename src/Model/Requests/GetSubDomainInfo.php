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

namespace RossMitchell\UpdateCloudFlare\Model\Requests;

use RossMitchell\UpdateCloudFlare\Abstracts\Curl;
use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use Symfony\Component\Console\Exception\LogicException;

class GetSubDomainInfo extends Curl
{
    /**
     * @var Headers
     */
    private $headers;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var GetDnsZones
     */
    private $dnsZones;
    /**
     * @var string
     */
    private $subDomainId;
    /**
     * @var string
     */
    private $subDomainIpAddress;
    /**
     * @var string
     */
    private $subDomain;

    /**
     * GetSubDomainInfo constructor.
     *
     * @param Headers     $headers
     * @param Config      $config
     * @param GetDnsZones $dnsZones
     */
    public function __construct(Headers $headers, Config $config, GetDnsZones $dnsZones)
    {
        $this->headers  = $headers;
        $this->config   = $config;
        $this->dnsZones = $dnsZones;
    }

    /**
     * @return string
     * @throws LogicException
     * @throws \RuntimeException
     * @throws CloudFlareException
     */
    public function getSubDomainId(): string
    {
        if ($this->subDomainId === null) {
            $this->collectionInformation();
        }

        return $this->subDomainId;
    }

    /**
     * @return string
     * @throws LogicException
     * @throws \RuntimeException
     * @throws CloudFlareException
     */
    public function getSubDomainIpAddress(): string
    {
        if ($this->subDomainIpAddress === null) {
            $this->collectionInformation();
        }

        return $this->subDomainIpAddress;
    }

    /**
     * @param string $subDomain
     *
     * @return GetSubDomainInfo
     */
    public function setSubDomain(string $subDomain): GetSubDomainInfo
    {
        $this->subDomain = $subDomain;

        return $this;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getSubDomain(): string
    {
        if (null === $this->subDomain) {
            throw new LogicException('You must set the sub domain');
        }

        return $this->subDomain;
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
     * @throws CloudFlareException
     */
    public function getUrl(): string
    {
        $baseUrl     = $this->config->getApiUrl();
        $zoneID      = $this->dnsZones->getZoneInformation();
        $type        = 'A';
        $subDomain   = $this->getSubDomain();
        $domain      = $this->config->getBaseUrl();
        $ddnsAddress = "${subDomain}.${domain}";


        return "${baseUrl}zones/${zoneID}/dns_records?type=$type&name=$ddnsAddress";
    }

    /**
     * @throws LogicException
     * @throws \RuntimeException
     * @throws CloudFlareException
     */
    private function collectionInformation()
    {
        $result = \json_decode($this->makeRequest());
        if ($result->success === false) {
            $error = new CloudFlareException();
            $error->setDetails($result, self::class);
            throw $error;
        }
        $details                  = $result->result[0];
        $this->subDomainId        = $details->id;
        $this->subDomainIpAddress = $details->content;
    }
}
