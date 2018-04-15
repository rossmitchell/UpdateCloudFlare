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

namespace RossMitchell\UpdateCloudFlare\Tests\Data\Config;

use PHLAK\Config\Config as ConfigLoader;
use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Exceptions\MissingConfigException;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class InvalidConfigTest
 * @testdox RossMitchell\UpdateCloudFlare\Data\Config
 * @package RossMitchell\UpdateCloudFlare\Tests\Data\Config
 */
class InvalidConfigTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var ConfigLoader
     */
    private $configLoader;

    /**
     * @test
     */
    public function willThrowAnExceptionIfConfigFileDoesNotExist()
    {
        $this->expectException(MissingConfigException::class);

        $this->getConfigClass('not/a/real/file');
    }

    /**
     * @test
     */
    public function willThrowAnExceptionIfInvalidSubDomainPassed()
    {
        $configClass = $this->getConfigClass('tests/_files/nonArraySubDomain.json');
        $this->expectException(LogicException::class);
        $configClass->getSubDomains();
    }

    /**
     * @test
     */
    public function canHandleASingleSubDomainInTheConfig()
    {
        $configFile  = 'tests/_files/singleSubDomain.json';
        $configClass = $this->getConfigClass($configFile);
        $expected    = ['www'];
        $actual      = $configClass->getSubDomains();
        $this->assertInternalType('array', $actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @param string $configFile
     *
     * @return Config
     */
    private function getConfigClass(string $configFile): Config
    {
        $configLoader = $this->configLoader;

        return new Config($configLoader, $configFile);
    }
}
