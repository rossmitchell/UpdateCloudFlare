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

namespace RossMitchell\UpdateCloudFlare\Data;

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class GetSubDomainInfo
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class GetSubDomainInfo implements RequestInterface
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
     * @var CurlInterface
     */
    private $curl;

    /**
     * GetSubDomainInfo constructor.
     *
     * @param HeadersInterface $headers
     * @param ConfigInterface  $config
     * @param GetDnsZones      $dnsZones
     * @param CurlInterface    $curl
     */
    public function __construct(HeadersInterface $headers, ConfigInterface $config, GetDnsZones $dnsZones, CurlInterface $curl)
    {
        $this->headers  = $headers;
        $this->config   = $config;
        $this->dnsZones = $dnsZones;
        $this->curl     = $curl;
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
     * @return GetSubDomainInfo
     */
    public function setSubDomain(string $subDomain): GetSubDomainInfo
    {
        $this->subDomain = $subDomain;

        return $this;
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
        $fullDomain = "${subDomain}.${domain}";


        return "${baseUrl}zones/${zoneID}/dns_records?type=$type&name=$fullDomain";
    }

    /**
     * @throws LogicException
     * @throws \RuntimeException
     * @throws CloudFlareException
     */
    private function collectionInformation()
    {
        $result = \json_decode($this->curl->makeRequest($this));
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
