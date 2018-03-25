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
use RossMitchell\UpdateCloudFlare\Command\TestCommand;
use RossMitchell\UpdateCloudFlare\Data\Config;
use Silly\Edition\PhpDi\Application;

require_once __DIR__.'/../vendor/autoload.php';
$containerBuilder = new ContainerBuilder();
$configFile       = $_ENV['config.file'] ?? 'app/config.json';
$containerBuilder->addDefinitions(
    [
        'config.file' => $configFile,
        Config::class => DI\create()->constructor(DI\get(ConfigReader::class), DI\get('config.file')),
    ]
);
$container = $containerBuilder->build();
$app       = new Application('CloudFlare CLI Tool', 'v0.1.0', $container);
$app->command('test', TestCommand::class)
    ->descriptions(
        'A Test Command'
    );
$app->run();
