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

namespace RossMitchell\UpdateCloudFlare\Responses;

use RossMitchell\UpdateCloudFlare\Abstracts\CloudFlareResponse;
use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\ListZoneResultsFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ListZones
 * @package RossMitchell\UpdateCloudFlare\Responses
 */
class ListZones extends CloudFlareResponse
{
    /**
     * @var ListZonesResult[]
     */
    private $result;
    /**
     * @var ListZoneResultsFactory
     */
    private $zoneResultsFactory;

    /**
     * ListZones constructor.
     *
     * @param ListZoneResultsFactory $zoneResultsFactory
     * @param string                 $rawResult
     */
    public function __construct(ListZoneResultsFactory $zoneResultsFactory, string $rawResult)
    {
        parent::__construct($rawResult);
        $this->zoneResultsFactory = $zoneResultsFactory;
    }

    /**
     * @param $result
     *
     * @throws LogicException
     */
    public function setResult($result)
    {
        $results = [];
        if (!\is_array($result)) {
            $this->result = $results;

            return;
        }

        foreach ($result as $data) {
            $results[] = $this->zoneResultsFactory->create($data);
        }
        $this->result = $results;
    }

    /**
     * @return ListZonesResult[]
     */
    public function getResult(): array
    {
        return $this->result;
    }
}
