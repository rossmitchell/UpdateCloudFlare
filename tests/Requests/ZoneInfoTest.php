<?php declare(strict_types = 1);
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

namespace RossMitchell\UpdateCloudFlare\Tests\Requests;

use RossMitchell\UpdateCloudFlare\Requests\ZoneInfo;

/**
 * Class ZoneInfoTest
 * @testdox RossMitchell\UpdateCloudFlare\Requests\ZoneInfo
 * @package RossMitchell\UpdateCloudFlare\Tests\Requests
 */
class ZoneInfoTest extends AbstractRequest
{
    /**
     * @Inject
     * @var ZoneInfo
     */
    private $zoneInfo;

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->zoneInfo;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'X-Auth-Email: test@example.com',
            'X-Auth-Key: 123456789',
            'Content-Type: application/json',
        ];
    }

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return 'GET';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return 'https://api.cloudflare.com/client/v4/zones?name=example.com';
    }
}
