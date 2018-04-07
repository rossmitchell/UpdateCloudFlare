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

namespace RossMitchell\UpdateCloudFlare\Factories\Responses;

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\ListZoneResultsFactory;
use RossMitchell\UpdateCloudFlare\Responses\ListZones;

/**
 * Class ListZoneFactory
 * @package RossMitchell\UpdateCloudFlare\Factories\Responses
 */
class ListZoneFactory
{
    /**
     * @var ListZoneResultsFactory
     */
    private $zoneResultsFactory;

    /**
     * ListZoneFactory constructor.
     *
     * @param ListZoneResultsFactory $zoneResultsFactory
     */
    public function __construct(ListZoneResultsFactory $zoneResultsFactory)
    {
        $this->zoneResultsFactory = $zoneResultsFactory;
    }

    /**
     * @param string $data
     *
     * @return ListZones
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function create(string $data): ListZones
    {
        return new ListZones($this->zoneResultsFactory, $data);
    }
}
