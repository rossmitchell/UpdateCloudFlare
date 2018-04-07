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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results\ListZoneResult;

use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ThrowExceptionsTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\ListZonesResult
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results\ListZoneResult
 */
class ThrowExceptionsTest extends AbstractClass
{
    /**
     * @test
     */
    public function willThrowAnExceptionIfTheIdIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->id);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheNameIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->name);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheDevelopmentModeIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->development_mode);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOriginalNameServersIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->original_name_servers);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOriginalRegistrarIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->original_registrar);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOriginalDnsHostIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->original_dnshost);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheCreatedOnIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->created_on);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheModifiedOnIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->modified_on);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheOwnerIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->owner);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePermissionsIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->permissions);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePlanIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->plan);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfThePlanPendingIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->plan_pending);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheStatusIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->status);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfIsPausedIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->paused);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheTypeIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->type);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheNameServersIsMissing()
    {
        $json = $this->getExampleJson();
        unset($json->name_servers);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }
}
