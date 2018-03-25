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

namespace RossMitchell\UpdateCloudFlare\Command;

use RossMitchell\UpdateCloudFlare\Abstracts\Command;
use RossMitchell\UpdateCloudFlare\Data\Config;
use RossMitchell\UpdateCloudFlare\Model\Requests\GetSubDomainInfo;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var GetSubDomainInfo
     */
    private $ipAddress;

    /**
     * TestCommand constructor.
     *
     * @param Config           $config
     * @param GetSubDomainInfo $ipAddress
     * @param string|null      $name
     *
     * @throws LogicException
     */
    public function __construct(Config $config, GetSubDomainInfo $ipAddress, string $name = null)
    {
        parent::__construct($name);
        $this->config    = $config;
        $this->ipAddress = $ipAddress;
    }

    public function runCommand(InputInterface $input, OutputInterface $output)
    {
        $ipAddress = $this->ipAddress->getSubDomainIpAddress();
        $id = $this->ipAddress->getSubDomainId();
        $output->writeln('IP Address: ' . $ipAddress);
        $output->writeln('CloudFlare ID: ' . $id);
        $output->writeln($this->config->getEmailAddress());
    }
}
