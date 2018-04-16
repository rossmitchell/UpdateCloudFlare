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

use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Tests\AbstractTestClass;

/**
 * Class ConfigTest
 * @testdox RossMitchell\UpdateCloudFlare\Data\Config
 * @package RossMitchell\UpdateCloudFlare\Tests\Data
 */
class ConfigTest extends AbstractTestClass
{
    /**
     * @Inject
     * @var Config
     */
    private $config;

    /**
     * @test
     */
    public function canReadTheEmailAddressFromTheConfigFile(): void
    {
        $this->assertEquals('test@example.com', $this->config->getEmailAddress());
    }

    /**
     * @test
     */
    public function canReadTheBaseUrlFromTheConfigFile(): void
    {
        $this->assertEquals('example.com', $this->config->getBaseUrl());
    }

    /**
     * @test
     */
    public function canReadTheSubDomainsFromTheConfigFile(): void
    {
        $expectedSubDomains = ['www'];
        $actualSubDomains   = $this->config->getSubDomains();
        $this->assertInternalType('array', $actualSubDomains);
        $this->assertEquals($expectedSubDomains, $actualSubDomains);
    }

    /**
     * @test
     */
    public function canReadTheApiKeyFromTheConfigFile(): void
    {
        $this->assertEquals('123456789', $this->config->getApiKey());
    }

    /**
     * @test
     */
    public function canReadTheApiUrlFromTheConfigFile(): void
    {
        $this->assertEquals('https://api.cloudflare.com/client/v4/', $this->config->getApiUrl());
    }

}
