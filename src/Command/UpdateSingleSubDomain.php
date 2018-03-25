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
use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Model\UpdateSubDomain;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateSingleSubDomain extends Command
{
    /**
     * @var UpdateSubDomain
     */
    private $subDomain;
    /**
     * @var Config
     */
    private $config;

    /**
     * UpdateSubDomains constructor.
     *
     * @param UpdateSubDomain $subDomain
     * @param Config          $config
     * @param string|null     $name
     */
    public function __construct(UpdateSubDomain $subDomain, Config $config, string $name = null)
    {
        parent::__construct($name);
        $this->subDomain = $subDomain;
        $this->config    = $config;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws CloudFlareException
     */
    public function runCommand(InputInterface $input, OutputInterface $output)
    {
        $newIpAddress = $input->getOption('ip-address');
        if (!empty($newIpAddress)) {
            $this->subDomain->setIpAddress($newIpAddress);
        }
        $subDomain         = $input->getArgument('subDomain');
        $allowedSubDomains = $this->config->getSubDomains();
        if (!\in_array($subDomain, $allowedSubDomains, true)) {
            throw new LogicException("$subDomain is not in the list of allowed sub domains");
        }

        $this->subDomain->setSubDomain($subDomain);
        $output->writeln("Going to check and update IP for the $subDomain sub domain");
        $message = $this->subDomain->updateSubDomain();
        $output->writeln($message);
    }
}
