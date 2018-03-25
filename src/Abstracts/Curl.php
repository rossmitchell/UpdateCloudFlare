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

namespace RossMitchell\UpdateCloudFlare\Abstracts;

use Symfony\Component\Console\Exception\LogicException;

abstract class Curl
{
    /**
     * Used to make the request
     *
     * @return mixed
     * @throws \Symfony\Component\Console\Exception\LogicException
     * @throws \RuntimeException
     */
    final public function makeRequest()
    {

        $curl = \curl_init();
        $this->setRequiredCurlOptions($curl);
        $this->setOptionalCurlOptions($curl);

        return $this->sendRequest($curl);
    }

    /**
     * If headers need to be sent through then they can be returned with this method. If not return an empty array
     *
     * @return array
     */
    abstract public function getHeaders(): array;

    /**
     * They type of request that is going to be made
     *
     * @return string
     */
    abstract public function getRequestType(): string;

    /**
     * If the request needs data to be sent though return it here. If not return an empty array
     *
     * @return array
     */
    abstract public function getFields(): array;

    /**
     * Return the URL that the request should be made to
     *
     * @return string
     */
    abstract public function getUrl(): string;

    /**
     * @param $curl
     */
    private function setRequiredCurlOptions($curl): void
    {
        \curl_setopt($curl, \CURLOPT_URL, $this->getUrl());
        \curl_setopt($curl, \CURLOPT_USERAGENT, 'curl');
        \curl_setopt($curl, \CURLOPT_CUSTOMREQUEST, $this->getRequestType());
        \curl_setopt($curl, \CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param $curl
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    private function setOptionalCurlOptions($curl): void
    {
        $fields     = $this->getFields();
        $headers    = $this->getHeaders();
        $hasFields  = \count($fields) > 0;
        $hasHeaders = \count($headers) > 0;
        if ($hasFields === true) {
            \curl_setopt($curl, \CURLOPT_POSTFIELDS, $this->getFieldsString($fields));
        }
        if ($hasHeaders === true) {
            \curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        }
    }

    /**
     * @param $curl
     *
     * @return mixed
     * @throws \RuntimeException
     */
    private function sendRequest($curl)
    {
        $result = \curl_exec($curl);

        if (\curl_error($curl)) {
            throw new \RuntimeException(\curl_error($curl));
        }
        \curl_close($curl);

        return $result;
    }

    /**
     * Converts an array of fields into a string that can be sent through
     *
     * @param array $fields
     *
     * @return string
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    private function getFieldsString(array $fields): string
    {
        $fieldsString = \json_encode($fields);
        if ($fieldsString === false) {
            throw new LogicException('Unable to encode the fields');
        }

        return $fieldsString;
    }
}
