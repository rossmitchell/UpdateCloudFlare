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

use RossMitchell\UpdateCloudFlare\Requests\IfConfig;

/**
 * Class IfConfigTest
 * @testdox RossMitchell\UpdateCloudFlare\Requests\IfConfig
 * @package RossMitchell\UpdateCloudFlare\Tests\Requests
 */
class IfConfigTest extends AbstractRequest
{
    /**
     * @Inject
     * @var IfConfig
     */
    private $request;

    /**
     * @return IfConfig
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [];
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
        return 'http://ifconfig.co';
    }
}
