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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results\ListZoneResult;

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\ListZoneResultsFactory;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class AbstractClass
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results\ListZoneResult
 */
class AbstractClass extends AbstractTestClass
{
    /**
     * @Inject
     * @var ListZoneResultsFactory
     */
    private $factory;

    protected function createClass(\stdClass $json = null)
    {
        if ($json === null) {
            $json = $this->getExampleJson();
        }

        return $this->factory->create($json);
    }

    /**
     * Taken from here https://api.cloudflare.com/#zone-list-zones
     * @return \stdClass
     */
    protected function getExampleJson(): \stdClass
    {
        $data = <<<JSON
{
    "id": "023e105f4ecef8ad9ca31a8372d0c353",
    "name": "example.com",
    "development_mode": 7200,
    "original_name_servers": [
        "ns1.originaldnshost.com",
        "ns2.originaldnshost.com"
    ],
    "original_registrar": "GoDaddy",
    "original_dnshost": "NameCheap",
    "created_on": "2014-01-01T05:20:00.12345Z",
    "modified_on": "2014-01-01T05:20:00.12345Z",
    "owner": {
        "id": "7c5dae5552338874e5053f2534d2767a",
        "email": "user@example.com",
        "owner_type": "user"
    },
    "permissions": [
        "#zone:read",
        "#zone:edit"
    ],
    "plan": {
        "id": "e592fd9519420ba7405e1307bff33214",
        "name": "Pro Plan",
        "price": 20,
        "currency": "USD",
        "frequency": "monthly",
        "legacy_id": "pro",
        "is_subscribed": true,
        "can_subscribe": true
    },
    "plan_pending": {
        "id": "e592fd9519420ba7405e1307bff33214",
        "name": "Pro Plan",
        "price": 20,
        "currency": "USD",
        "frequency": "monthly",
        "legacy_id": "pro",
        "is_subscribed": true,
        "can_subscribe": true
    },
    "status": "active",
    "paused": false,
    "type": "full",
    "name_servers": [
        "tony.ns.cloudflare.com",
        "woz.ns.cloudflare.com"
    ]
}
JSON;

        return \json_decode($data);
    }
}
