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

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class UpdateDnsRecord
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class UpdateDnsRecord implements RequestInterface
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
     * @var CurlInterface
     */
    private $curl;

    /**
     * UpdateDnsRecord constructor.
     *
     * @param ConfigInterface  $config
     * @param HeadersInterface $headers
     * @param GetDnsZones      $dnsZones
     * @param GetSubDomainInfo $subDomainInfo
     * @param CurlInterface    $curl
     */
    public function __construct(
        ConfigInterface $config,
        HeadersInterface $headers,
        GetDnsZones $dnsZones,
        GetSubDomainInfo $subDomainInfo,
        CurlInterface $curl
    ) {
        $this->config        = $config;
        $this->headers       = $headers;
        $this->subDomainInfo = $subDomainInfo;
        $this->dnsZones      = $dnsZones;
        $this->curl          = $curl;
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
     * @throws \RuntimeException
     * @throws CloudFlareException
     */
    public function changeIpAddress(): string
    {
        $result = \json_decode($this->curl->makeRequest($this));
        if ($result->success === false) {
            $error = new CloudFlareException();
            $error->setDetails($result, self::class);
            throw $error;
        }

        $details = $result->result;
        $host    = $details->name;
        $newIp   = $details->content;

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
        return 'PUT';
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
        $fullDomain = "${subDomain}.${domain}";
        $type        = 'A';
        $ip          = $this->getIpAddress();

        return [
            'type'    => $type,
            'name'    => $fullDomain,
            'content' => $ip,
        ];
    }

    /**
     * Return the URL that the request should be made to
     *
     * @return string
     * @throws LogicException
     * @throws \RuntimeException
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
