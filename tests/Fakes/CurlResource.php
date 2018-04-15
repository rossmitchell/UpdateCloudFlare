<?php
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

namespace RossMitchell\UpdateCloudFlare\Tests\Fakes;

use RossMitchell\UpdateCloudFlare\Interfaces\CurlResourceInterface;

/**
 * Class CurlResource - Used to allow testing of the main curl class
 * @package RossMitchell\UpdateCloudFlare\Tests\Fakes
 */
class CurlResource implements CurlResourceInterface
{
    /**
     * @var string
     */
    private $error;
    /**
     * @var array
     */
    private $options = [];

    /**
     * Used To initialise the curl resource
     *
     * @return bool
     */
    public function curlInit()
    {
        return true;
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
        $this->options[$option] = $value;
    }

    /**
     * @param $option
     *
     * @return mixed
     */
    public function getOption($option)
    {
        if (!isset($this->options[$option])) {
            throw new \LogicException("${option} has not been set");
        }

        return $this->options[$option];
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
        return 'worked';
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
        if ($this->error !== null) {
            return $this->error;
        }

        return false;
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

    }

    /**
     * @param string $error
     */
    public function setError(string $error)
    {
        $this->error = $error;
    }
}
