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

use RossMitchell\UpdateCloudFlare\Factories\Responses\Results\OwnerFactory;
use RossMitchell\UpdateCloudFlare\Responses\Results\Owner;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Helpers\ListZonesResponse;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class OwnerTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\Owner
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results
 */
class OwnerTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var OwnerFactory
     */
    private $factory;

    /**
     * @Inject
     * @var ListZonesResponse
     */
    private $responseHelper;

    /**
     * @test
     */
    public function canBeCreatedUsingTheFactory(): void
    {
        $class = $this->createClass();
        $this->assertInstanceOf(Owner::class, $class);
    }

    /**
     * @test
     */
    public function canReturnTheId(): void
    {
        $class = $this->createClass();
        $this->assertEquals('7c5dae5552338874e5053f2534d2767a', $class->getId());
    }

    /**
     * @test
     */
    public function canReturnTheEmail(): void
    {
        $class = $this->createClass();
        $this->assertEquals('user@example.com', $class->getEmail());
    }

    /**
     * @test
     */
    public function canReturnTheOwnerType(): void
    {
        $class = $this->createClass();
        $this->assertEquals('user', $class->getOwnerType());
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheIdIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->id);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheEmailIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->email);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOwnerTypeIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->owner_type);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @param \stdClass|null $json
     *
     * @return Owner
     */
    private function createClass(\stdClass $json = null): Owner
    {
        if ($json === null) {
            $json = $this->getJson();
        }

        return $this->factory->create($json);
    }


    /**
     * Taken from here https://api.cloudflare.com/#zone-list-zones
     * @return \stdClass
     */
    private function getJson(): \stdClass
    {
        $json = $this->responseHelper->getOwnerJson();

        return \json_decode($json);
    }
}
