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

namespace RossMitchell\UpdateCloudFlare\Factories\Data;

use RossMitchell\UpdateCloudFlare\Data\IpType;
use RossMitchell\UpdateCloudFlare\Data\SubDomainInfo;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class SubDomainInfoFactory
 * @package RossMitchell\UpdateCloudFlare\Factories\Data
 */
class SubDomainInfoFactory
{
    /**
     * @var SubDomainInfo[]
     */
    private $created = [];

    /**
     * @param string $subDomain
     * @param string $type
     *
     * @return SubDomainInfo
     * @throws LogicException
     */
    public function create(string $subDomain, string $type): SubDomainInfo
    {
        $ipType              = new IpType($type);
        $info                = new SubDomainInfo($subDomain, $ipType);
        $key                 = $this->getKey($subDomain, $type);
        $this->created[$key] = $info;

        return $info;
    }

    /**
     * @param string $subDomain
     * @param string $type
     *
     * @return SubDomainInfo
     * @throws LogicException
     */
    public function get(string $subDomain, string $type): SubDomainInfo
    {
        $key = $this->getKey($subDomain, $type);
        if (!isset($this->created[$key])) {
            $this->create($subDomain, $type);
        }

        return $this->created[$key];
    }

    /**
     * @param string $subDomain
     * @param string $type
     *
     * @return string
     */
    private function getKey(string $subDomain, string $type): string
    {
        return "${subDomain}_${type}";
    }
}
