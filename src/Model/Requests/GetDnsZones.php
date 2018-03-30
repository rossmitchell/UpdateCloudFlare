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

namespace RossMitchell\UpdateCloudFlare\Model\Requests;

use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;

/**
 * This is used to get the zone information for the base domain
 *
 * @package RossMitchell\UpdateCloudFlare
 */
class GetDnsZones implements RequestInterface
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
     * @var string
     */
    private $zoneId;
    /**
     * @var CurlInterface
     */
    private $curl;

    /**
     * GetDnsZones constructor.
     *
     * @param ConfigInterface  $config
     * @param HeadersInterface $headers
     * @param CurlInterface    $curl
     */
    public function __construct(ConfigInterface $config, HeadersInterface $headers, CurlInterface $curl)
    {
        $this->config  = $config;
        $this->headers = $headers;
        $this->curl    = $curl;
    }

    /**
     * @return string
     * @throws \Symfony\Component\Console\Exception\LogicException
     * @throws \RuntimeException
     * @throws CloudFlareException
     */
    public function getZoneInformation(): string
    {
        $result = \json_decode($this->curl->makeRequest($this));

        if ($result->success !== true) {
            $error = new CloudFlareException();
            $error->setDetails($result, self::class);
            throw $error;
        }

        $this->zoneId = $result->result[0]->id;

        return $this->zoneId;
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
     */
    public function getUrl(): string
    {
        $baseUrl = $this->config->getApiUrl();
        $domain  = $this->config->getBaseUrl();

        return "${baseUrl}zones?name=${domain}";
    }
}
