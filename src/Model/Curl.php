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

namespace RossMitchell\UpdateCloudFlare\Model;


use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlResourceInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\RequestInterface;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class Curl
 * @package RossMitchell\UpdateCloudFlare\Model
 */
class Curl implements CurlInterface
{
    /**
     * @var CurlResourceInterface
     */
    private $curlResource;

    /**
     * Curl constructor.
     *
     * @param CurlResourceInterface $curlResource
     */
    public function __construct(CurlResourceInterface $curlResource)
    {
        $this->curlResource = $curlResource;
    }

    /**
     * @param RequestInterface $request
     *
     * @return string
     * @throws LogicException
     * @throws \RuntimeException
     */
    public function makeRequest(RequestInterface $request): string
    {
        $curl = \curl_init();
        $this->setRequiredCurlOptions($request, $curl);
        $this->setOptionalCurlOptions($request, $curl);

        return $this->sendRequest($curl);
    }

    /**
     * @param RequestInterface $request
     * @param resource         $curl
     */
    private function setRequiredCurlOptions(RequestInterface $request, $curl): void
    {
        $resource = $this->curlResource;
        $resource->setOption($curl, \CURLOPT_URL, $request->getUrl());
        $resource->setOption($curl, \CURLOPT_USERAGENT, 'curl');
        $resource->setOption($curl, \CURLOPT_CUSTOMREQUEST, $request->getRequestType());
        $resource->setOption($curl, \CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param RequestInterface $request
     * @param resource         $curl
     *
     * @throws LogicException
     */
    private function setOptionalCurlOptions(RequestInterface $request, $curl): void
    {
        $fields     = $request->getFields();
        $headers    = $request->getHeaders();
        $resource   = $this->curlResource;
        $hasFields  = \count($fields) > 0;
        $hasHeaders = \count($headers) > 0;
        if ($hasFields === true) {
            $resource->setOption($curl, \CURLOPT_POSTFIELDS, $this->getFieldsString($fields));
        }
        if ($hasHeaders === true) {
            $resource->setOption($curl, \CURLOPT_HTTPHEADER, $headers);
        }
    }

    /**
     * @param resource $curl
     *
     * @return mixed
     * @throws \RuntimeException
     */
    private function sendRequest($curl)
    {
        $resource = $this->curlResource;
        $result = $resource->curlExec($curl);
        $error = $resource->curlError($curl);
        if ($error !== false) {
            throw new \RuntimeException($error);
        }
        $resource->curlClose($curl);

        return $result;
    }

    /**
     * Converts an array of fields into a string that can be sent through
     *
     * @param array $fields
     *
     * @return string
     * @throws LogicException
     */
    private function getFieldsString(array $fields): string
    {
        return \json_encode($fields);
    }
}
