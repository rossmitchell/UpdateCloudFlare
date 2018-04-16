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

namespace RossMitchell\UpdateCloudFlare\Helpers;


use RossMitchell\UpdateCloudFlare\Interfaces\CurlResourceInterface;

/**
 * Class CurlResource - This is a way of further abstracting the curl calls out of a class to help with testing
 * @package RossMitchell\UpdateCloudFlare\Helpers
 */
class CurlResource implements CurlResourceInterface
{

    /**
     * Used To initialise the curl resource
     *
     * @return resource
     */
    public function curlInit()
    {
        return \curl_init();
    }

    /**
     * Used to set a curl option
     *
     * @param resource $curl
     * @param int      $option
     * @param mixed    $value
     *
     * @return void
     */
    public function setOption($curl, int $option, $value): void
    {
        \curl_setopt($curl, $option, $value);
    }

    /**
     * Used to make the curl request
     *
     * @param $curl
     *
     * @return mixed
     */
    public function curlExec($curl)
    {
        return \curl_exec($curl);
    }

    /**
     * Used to check if there has been an error with the request
     *
     * @param $curl
     *
     * @return mixed
     */
    public function curlError($curl)
    {
        return \curl_error($curl);
    }

    /**
     * Used to close the connection
     *
     * @param $curl
     *
     * @return void
     */
    public function curlClose($curl): void
    {
        \curl_close($curl);
    }
}
