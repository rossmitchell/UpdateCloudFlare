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

namespace RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers;

/**
 * Class ListZonesResponse - Provides a standard response for the List Zones call
 * @package RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers
 */
class ListZonesResponse extends AbstractCloudFlareResponse
{
    /**
     * @return string
     */
    public function getOwnerJson(): string
    {
        return <<<JSON
{
    "id": "7c5dae5552338874e5053f2534d2767a",
    "email": "user@example.com",
    "owner_type": "user"
}
JSON;
    }

    /**
     * @return string
     */
    public function getPlanJson(): string
    {
        return <<<JSON
{
    "id": "e592fd9519420ba7405e1307bff33214",
    "name": "Pro Plan",
    "price": 20,
    "currency": "USD",
    "frequency": "monthly",
    "legacy_id": "pro",
    "is_subscribed": true,
    "can_subscribe": true
}
JSON;
    }

    /**
     * @return string
     */
    public function getResultJson(): string
    {
        $owner = $this->getOwnerJson();
        $plan  = $this->getPlanJson();

        return <<<JSON
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
    "owner": $owner,
    "permissions": [
        "#zone:read",
        "#zone:edit"
    ],
    "plan": $plan,
    "plan_pending": $plan,
    "status": "active",
    "paused": false,
    "type": "full",
    "name_servers": [
        "tony.ns.cloudflare.com",
        "woz.ns.cloudflare.com"
    ]
}
JSON;
    }
}
