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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results;

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\PlanFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\Plan;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class PlanTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\Plan
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results
 */
class PlanTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var PlanFactory
     */
    private $factory;

    /**
     * @test
     */
    public function canCreateTheClassUsingTheFactory()
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Plan::class, $class);
    }

    /**
     * @test
     */
    public function canReturnTheId()
    {
        $class = $this->createClass();
        $this->assertEquals('e592fd9519420ba7405e1307bff33214', $class->getId());
    }

    /**
     * @test
     */
    public function canReturnTheName()
    {
        $class = $this->createClass();
        $this->assertEquals('Pro Plan', $class->getName());
    }

    /**
     * @test
     */
    public function canReturnThePrice()
    {
        $class = $this->createClass();
        $this->assertEquals(20, $class->getPrice());
    }

    /**
     * @test
     */
    public function canReturnTheCurrency()
    {
        $class = $this->createClass();
        $this->assertEquals('USD', $class->getCurrency());
    }

    /**
     * @test
     */
    public function canReturnTheFrequency()
    {
        $class = $this->createClass();
        $this->assertEquals('monthly', $class->getFrequency());
    }

    /**
     * @test
     */
    public function canReturnTheLegacyId()
    {
        $class = $this->createClass();
        $this->assertEquals('pro', $class->getLegacyId());
    }

    /**
     * @test
     */
    public function canReturnTheIsSubscribed()
    {
        $class = $this->createClass();
        $this->assertTrue($class->getIsSubscribed());
    }

    /**
     * @test
     */
    public function canReturnTheCanSubscribe()
    {
        $class = $this->createClass();
        $this->assertTrue($class->getCanSubscribe());
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheIdIsMissing()
    {
        $json = $this->getJson();
        unset($json->id);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheNameIsMissing()
    {
        $json = $this->getJson();
        unset($json->name);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePriceIsMissing()
    {
        $json = $this->getJson();
        unset($json->price);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheCurrencyIsMissing()
    {
        $json = $this->getJson();
        unset($json->currency);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheFrequencyIsMissing()
    {
        $json = $this->getJson();
        unset($json->frequency);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheLegacyIdIsMissing()
    {
        $json = $this->getJson();
        unset($json->legacy_id);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheIsSubscribedIsMissing()
    {
        $json = $this->getJson();
        unset($json->is_subscribed);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheCanSubscribeIsMissing()
    {
        $json = $this->getJson();
        unset($json->can_subscribe);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @param \stdClass|null $json
     *
     * @return Plan
     */
    private function createClass(\stdClass $json = null): Plan
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

        return \json_decode($json);
    }
}
