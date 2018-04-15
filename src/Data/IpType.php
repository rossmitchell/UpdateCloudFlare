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

use Symfony\Component\Console\Exception\LogicException;

/**
 * Class IpType
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class IpType
{
    const IP_V4 = 'A';
    const IP_V6 = 'AAAA';

    /**
     * @var string
     */
    private $type;

    /**
     * IpType constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return void
     * @throws LogicException
     */
    private function setType(string $type): void
    {
        switch ($type) {
            case self::IP_V4:
            case self::IP_V6;
                $this->type = $type;
                break;
            default:
                throw new LogicException('IP Type must be either '.self::IP_V4.' or '.self::IP_V6);
        }
    }

}
