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

namespace RossMitchell\UpdateCloudFlare\Interfaces;

/**
 * Interface RequestInterface
 * @package RossMitchell\UpdateCloudFlare\Interfaces
 */
interface RequestInterface
{
    /**
     * If headers need to be sent through then they can be returned with this method. If not return an empty array
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * They type of request that is going to be made
     *
     * @return string
     */
    public function getRequestType(): string;

    /**
     * If the request needs data to be sent though return it here. If not return an empty array
     *
     * @return array
     */
    public function getFields(): array;

    /**
     * Return the URL that the request should be made to
     *
     * @return string
     */
    public function getUrl(): string;
}
