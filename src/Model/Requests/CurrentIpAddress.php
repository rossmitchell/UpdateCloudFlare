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

use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Requests\IfConfig;

/**
 * Class CurrentIpAddress
 * @package RossMitchell\UpdateCloudFlare\Model\Requests
 */
class CurrentIpAddress
{
    /**
     * @var CurlInterface
     */
    private $curl;
    /**
     * @var IfConfig
     */
    private $request;
    /**
     * @var string
     */
    private $ipAddress;

    /**
     * CurrentIpAddress constructor.
     *
     * @param CurlInterface $curl
     * @param IfConfig      $request
     */
    public function __construct(CurlInterface $curl, IfConfig $request)
    {
        $this->curl    = $curl;
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getCurrentIpAddress(): string
    {
        if ($this->ipAddress === null) {
            $rawResult       = $this->curl->makeRequest($this->request);
            $this->ipAddress = \trim($rawResult);
        }

        return $this->ipAddress;
    }
}
