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

namespace RossMitchell\UpdateCloudFlare\Tests;

use DI\Container;
use DI\ContainerBuilder;
use PHLAK\Config\Config as ConfigReader;
use PHPUnit\Framework\TestCase;
use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Data\Headers;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlResourceInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\Curl;
use RossMitchell\UpdateCloudFlare\Tests\Fakes\CurlResource;

/**
 * Class AbstractTestClass
 * @package RossMitchell\UpdateCloudFlare\Tests
 */
abstract class AbstractTestClass extends TestCase
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @throws \DI\DependencyException
     * @throws \Exception
     */
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);
        $defaultConfig = $this->getDefaultDiConfig();
        $builder->addDefinitions($defaultConfig);
        $config = $this->getDiConfig();
        $builder->addDefinitions($config);
        $this->container = $builder->build();
        $this->container->injectOn($this);
        parent::setUp();
    }

    /**
     * @return array
     */
    public function getDiConfig(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getDefaultDiConfig(): array
    {
        return [
            'config.file'                => $this->getConfigFile(),
            Config::class                => \DI\create()->constructor(\DI\get(ConfigReader::class),
                \DI\get('config.file')),
            CurlInterface::class         => \DI\get(Curl::class),
            ConfigInterface::class       => \DI\get(Config::class),
            HeadersInterface::class      => \DI\get(Headers::class),
            CurlResourceInterface::class => \DI\get(CurlResource::class),
        ];
    }

    /**
     * @return string
     */
    public function getConfigFile(): string
    {
        return 'tests/_files/testConfig.json';
    }
}
