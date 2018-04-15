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

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Factories\Responses\UpdateDnsRecordsFactory;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Requests\UpdateDnsRecords;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class UpdateDnsRecord
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class UpdateDnsRecord
{
    /**
     * @var CurlInterface
     */
    private $curl;
    /**
     * @var UpdateDnsRecordsFactory
     */
    private $responseFactory;

    /**
     * UpdateDnsRecord constructor.
     *
     * @param CurlInterface           $curl
     * @param UpdateDnsRecordsFactory $responseFactory
     */
    public function __construct(CurlInterface $curl, UpdateDnsRecordsFactory $responseFactory)
    {
        $this->curl            = $curl;
        $this->responseFactory = $responseFactory;
    }


    /**
     * @param UpdateDnsRecords $request
     *
     * @return bool
     * @throws CloudFlareException
     */
    public function changeIpAddress(UpdateDnsRecords $request): bool
    {
        $rawResult = \json_decode($this->curl->makeRequest($request));
        $result = $this->responseFactory->create($rawResult);
        $expectedIpAddress = $request->getSubDomainInfo()->getIpAddress();
        $newIpAddress = $result->getResult()->getContent();
        if ($newIpAddress !== $expectedIpAddress) {
            throw new LogicException('Ip Address has not been Updated');
        }

        return true;
    }
}
