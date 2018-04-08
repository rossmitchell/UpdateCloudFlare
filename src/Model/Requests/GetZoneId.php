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

namespace RossMitchell\UpdateCloudFlare\Model\Requests;

use RossMitchell\UpdateCloudFlare\Factories\Responses\ListZoneFactory;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Requests\ZoneInfo;
use RossMitchell\UpdateCloudFlare\Responses\ListZones;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class GetZoneId
 * @package RossMitchell\UpdateCloudFlare\Model\Requests
 */
class GetZoneId
{
    /**
     * @var CurlInterface
     */
    private $curl;
    /**
     * @var ZoneInfo
     */
    private $request;
    /**
     * @var array
     */
    private $zoneId = [];
    /**
     * @var ListZoneFactory
     */
    private $listZoneResults;
    /**
     * @var ListZones
     */
    private $result;

    /**
     * GetZoneId constructor.
     *
     * @param CurlInterface   $curl
     * @param ZoneInfo        $request
     * @param ListZoneFactory $listZoneResults
     */
    public function __construct(CurlInterface $curl, ZoneInfo $request, ListZoneFactory $listZoneResults)
    {
        $this->curl            = $curl;
        $this->request         = $request;
        $this->listZoneResults = $listZoneResults;
    }

    /**
     * @param int $index
     *
     * @return string
     * @throws LogicException
     */
    public function getZoneId(int $index = 0): string
    {
        if (!isset($this->zoneId[$index])) {
            $this->zoneId[$index] = $this->getIdFromResult($index);
        }

        return $this->zoneId[$index];
    }

    /**
     * @param int $index
     *
     * @return string
     * @throws LogicException
     */
    private function getIdFromResult(int $index = 0): string
    {
        $result = $this->getResult();
        $zones  = $result->getResult();
        if (!isset($zones[$index])) {
            throw new LogicException("Zone $index is not defined");
        }
        $zone = $zones[$index];

        return $zone->getId();
    }

    /**
     * @return ListZones
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    private function getResult(): ListZones
    {
        if ($this->result === null) {
            $rawResult    = \json_decode($this->curl->makeRequest($this->request));
            $this->result = $this->listZoneResults->create($rawResult);
        }

        return $this->result;
    }
}
