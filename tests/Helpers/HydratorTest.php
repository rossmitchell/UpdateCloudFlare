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

namespace RossMitchell\UpdateCloudFlare\Tests\Helpers;

use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\SetterExample;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class HydratorTest
 * @package RossMitchell\UpdateCloudFlare\Tests\Helpers
 */
class HydratorTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var Hydrator
     */
    private $hydrator;
    /**
     * @Inject
     * @var SetterExample
     */
    private $testClass;

    /**
     * @test
     */
    public function itCanSetAPropertyThatExistsInTheRawData(): void
    {
        $url       = 'http://www.example.com';
        $node      = 'url';
        $rawData   = "{ \"${node}\": \"${url}\"}";
        $testClass = $this->testClass;
        $hydrator  = $this->hydrator;
        $hydrator->setProperty($testClass, \json_decode($rawData), $node);
        $this->assertEquals($url, $testClass->getUrl());
    }

    /**
     * @test
     */
    public function itWontThrowAnExceptionIfThePropertyIsOptional(): void
    {
        $testClass = $this->testClass;
        $oldUrl    = 'http://www.example.com';
        $testClass->setUrl($oldUrl);
        $rawData = '{}';
        $this->hydrator->setProperty($testClass, \json_decode($rawData), 'url', false);
        $this->assertNotEquals($oldUrl, $testClass->getUrl());
        $this->assertNull($testClass->getUrl());
    }

    /**
     * @test
     */
    public function itWillThrowAnExceptionIfThePropertyIsRequired(): void
    {
        $testClass = $this->testClass;
        $rawData   = '{}';
        $this->expectException(LogicException::class);
        $this->hydrator->setProperty($testClass, \json_decode($rawData), 'url');
    }

    /**
     * @test
     */
    public function itWillThrowAnExceptionIfThereIsNoSetter(): void
    {
        $testClass = $this->testClass;
        $rawData   = '{"test":"test"}';
        $this->expectException(LogicException::class);
        $this->hydrator->setProperty($testClass, \json_decode($rawData), 'test');
    }
}
