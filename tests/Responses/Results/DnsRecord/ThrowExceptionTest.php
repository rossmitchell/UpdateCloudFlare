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

namespace RossMitchell\UpdateCloudFlare\Tests\Responses\Results\DnsRecord;

use Symfony\Component\Console\Exception\LogicException;

/**
 * Class DnsRecordTest
 * @testdox RossMitchell\UpdateCloudFlare\Responses\Results\DnsRecord
 * @package RossMitchell\UpdateCloudFlare\Tests\Responses\Results\DnsRecord
 */
class ThrowExceptionTest extends AbstractClass
{
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
    public function willThrowAnExceptionIfTheTypeIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->type);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheNameIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->name);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheContentIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->content);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheProxiableIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->proxiable);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheProxiedIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->proxied);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheTtlIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->ttl);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheLockedIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->locked);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheZoneIdIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->zone_id);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheZoneNameIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->zone_name);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheCreatedOnIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->created_on);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheModifiedOnIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->modified_on);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfTheDataIsMissing(): void
    {
        $json = $this->getJson();
        unset($json->data);
        $this->expectException(LogicException::class);
        $this->createClass($json);
    }
}
