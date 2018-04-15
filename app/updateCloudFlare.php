#!/usr/bin/env php
<?php
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

use DI\ContainerBuilder;
use PHLAK\Config\Config as ConfigReader;
use RossMitchell\UpdateCloudFlare\Command\UpdateSingleSubDomain;
use RossMitchell\UpdateCloudFlare\Command\UpdateSubDomains;
use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Data\Headers;
use RossMitchell\UpdateCloudFlare\Helpers\CurlResource;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\CurlResourceInterface;
use RossMitchell\UpdateCloudFlare\Interfaces\HeadersInterface;
use RossMitchell\UpdateCloudFlare\Model\Curl;
use Silly\Edition\PhpDi\Application;

require_once __DIR__.'/../vendor/autoload.php';
$containerBuilder = new ContainerBuilder();
$configFile       = $_ENV['config.file'] ?? 'app/config.json';
$containerBuilder->addDefinitions(
    [
        'config.file'                => $configFile,
        Config::class                => DI\create()->constructor(DI\get(ConfigReader::class), DI\get('config.file')),
        CurlResourceInterface::class => DI\get(CurlResource::class),
        CurlInterface::class         => DI\get(Curl::class),
        ConfigInterface::class       => DI\get(Config::class),
        HeadersInterface::class      => DI\get(Headers::class),
    ]
);
$container = $containerBuilder->build();
$app       = new Application('CloudFlare CLI Tool', 'v0.1.0', $container);
$app->command('update:all [--ip-address=]', UpdateSubDomains::class)
    ->descriptions(
        'Updates all configured sub domains',
        ['--ip-address' => 'Force the IP Address to use rather than fetching it']
    );
$app->command('update:sub-domain subDomain [--ip-address=]', UpdateSingleSubDomain::class)
    ->descriptions(
        'Update a named sub domain',
        [
            'subDomain'    => 'The sub domain to update',
            '--ip-address' => 'Force the IP Address to use rather than fetching it',
        ]
    );
$app->run();
