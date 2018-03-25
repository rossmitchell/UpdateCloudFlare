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

class UpdateDnsRecord extends Curl
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var Headers
     */
    private $headers;
    /**
     * @var GetSubDomainInfo
     */
    private $subDomainInfo;
    /**
     * @var GetDnsZones
     */
    private $dnsZones;
    /**
     * @var string
     */
    private $ipAddress;
    /**
     * @var string
     */
    private $subDomain;

    /**
     * UpdateDnsRecord constructor.
     *
     * @param Config           $config
     * @param Headers          $headers
     * @param GetDnsZones      $dnsZones
     * @param GetSubDomainInfo $subDomainInfo
     */
    public function __construct(
        Config $config,
        Headers $headers,
        GetDnsZones $dnsZones,
        GetSubDomainInfo $subDomainInfo
    ) {
        $this->config        = $config;
        $this->headers       = $headers;
        $this->subDomainInfo = $subDomainInfo;
        $this->dnsZones      = $dnsZones;
    }

    /**
     * @param string $ipAddress
     *
     * @return UpdateDnsRecord
     */
    public function setNewIpAddress(string $ipAddress): UpdateDnsRecord
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @return string
     * @throws LogicException
     */
    public function getIpAddress(): string
    {
        if ($this->ipAddress === null) {
            throw new LogicException('You must set the new IP Address');
        }
        return $this->ipAddress;
    }

    /**
     * @param string $subDomain
     *
     * @return UpdateDnsRecord
     */
    public function setSubDomain(string $subDomain): UpdateDnsRecord
    {
        $this->subDomain = $subDomain;
        $this->subDomainInfo->setSubDomain($subDomain);

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
     * @return string
     * @throws CloudFlareException
     */
    public function changeIpAddress(): string
    {
        $result = \json_decode($this->makeRequest());
        if ($result->success === false) {
            $error = new CloudFlareException();
            $error->setDetails($result, self::class);
            throw $error;
        }

        $details = $result->result;
        $host = $details->name;
        $newIp = $details->content;

        return "${host} has had its IP address update to ${newIp}";
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
        return "PUT";
    }

    /**
     * If the request needs data to be sent though return it here. If not return an empty array
     *
     * @return array
     * @throws LogicException
     */
    public function getFields(): array
    {
        $subDomain   = $this->getSubDomain();
        $domain      = $this->config->getBaseUrl();
        $ddnsAddress = "${subDomain}.${domain}";
        $type        = 'A';
        $ip          = $this->getIpAddress();

        return [
            'type'    => $type,
            'name'    => $ddnsAddress,
            'content' => $ip,
        ];
    }

    /**
     * Return the URL that the request should be made to
     *
     * @return string
     * @throws CloudFlareException
     */
    public function getUrl(): string
    {
        $baseUrl     = $this->config->getApiUrl();
        $zoneID      = $this->dnsZones->getZoneInformation();
        $subDomainId = $this->subDomainInfo->getSubDomainId();

        return "${baseUrl}zones/${zoneID}/dns_records/${subDomainId}";
    }
}
