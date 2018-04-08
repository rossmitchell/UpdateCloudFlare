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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses;

use RossMitchell\UpdateCloudFlare\Factories\Responses\ListZoneFactory;
use RossMitchell\UpdateCloudFlare\Responses\ListZones;
use RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ListZonesTest
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses
 */
class ListZonesTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var ListZoneFactory
     */
    private $factory;

    /**
     * @test
     */
    public function canCreateTheClassUsingTheFactory()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(ListZones::class, $class);
    }

    /**
     * @test
     */
    public function canReturnTheSuccess()
    {
        $class = $this->createClass();
        $this->assertTrue($class->isSuccess());
    }

    /**
     * @test
     */
    public function canReturnTheErrors()
    {
        $class  = $this->createClass();
        $errors = $class->getErrors();
        $this->assertInternalType('array', $errors);
        $this->assertEmpty($errors);
    }

    /**
     * @test
     */
    public function canReturnTheMessages()
    {
        $class    = $this->createClass();
        $messages = $class->getMessages();
        $this->assertInternalType('array', $messages);
        $this->assertEmpty($messages);
    }

    /**
     * @test
     */
    public function canReturnTheResult()
    {
        $class  = $this->createClass();
        $result = $class->getResult();
        $this->assertInternalType('array', $result);
        $this->assertCount(1, $result);
        $resultObject = $result[0];
        $this->assertInstanceOf(ListZonesResult::class, $resultObject);
    }

    /**
     * @test
     */
    public function canReturnTheResultInfo()
    {
        $class      = $this->createClass();
        $resultInfo = $class->getResultInfo();
        $this->assertInstanceOf(\stdClass::class, $resultInfo);
        $this->assertEquals(1, $resultInfo->page);
        $this->assertEquals(20, $resultInfo->per_page);
        $this->assertEquals(1, $resultInfo->count);
        $this->assertEquals(2000, $resultInfo->total_count);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheSuccessIsMissing()
    {
        $json = $this->getJson();
        unset($json->success);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheErrorsAreMissing()
    {
        $json = $this->getJson();
        unset($json->errors);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheMessagesAreMissing()
    {
        $json = $this->getJson();
        unset($json->messages);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheResultIsMissing()
    {
        $json = $this->getJson();
        unset($json->result);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willNotThrowAnExceptionIfTheResultInfoIsMissing()
    {
        $json = $this->getJson();
        unset($json->result_info);
        $class = $this->createClass($json);
        $this->assertNull($class->getResultInfo());
    }

    /**
     * @param \stdClass|null $json
     *
     * @return ListZones
     */
    private function createClass(\stdClass $json = null): ListZones
    {
        if ($json === null) {
            $json = $this->getJson();
        }

        return $this->factory->create($json);
    }

    /**
     * @return \stdClass
     */
    private function getJson(): \stdClass
    {
        $json = <<<JSON
{
  "success": true,
  "errors": [
    {}
  ],
  "messages": [
    {}
  ],
  "result": [
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
  ],
  "result_info": {
    "page": 1,
    "per_page": 20,
    "count": 1,
    "total_count": 2000
  }
}
JSON;

        return \json_decode($json);
    }
}
