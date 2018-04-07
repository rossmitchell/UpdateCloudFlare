<?php
declare(strict_types=1);
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

use RossMitchell\UpdateCloudFlare\Exceptions\CloudFlareException;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use RossMitchell\UpdateCloudFlare\Model\UpdateSubDomain;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UpdateSubDomains
 * @package RossMitchell\UpdateCloudFlare\Command
 */
class UpdateSubDomains extends Command
{
    /**
     * @var UpdateSubDomain
     */
    private $subDomain;
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * UpdateSubDomains constructor.
     *
     * @param UpdateSubDomain $subDomain
     * @param ConfigInterface $config
     * @param string|null     $name
     *
     * @throws LogicException
     */
    public function __construct(UpdateSubDomain $subDomain, ConfigInterface $config, string $name = null)
    {
        parent::__construct($name);
        $this->subDomain = $subDomain;
        $this->config = $config;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws LogicException
     * @throws \RuntimeException
     * @throws InvalidArgumentException
     * @throws CloudFlareException
     */
    public function runCommand(InputInterface $input, OutputInterface $output)
    {
        $newIpAddress = $input->getOption('ip-address');
        if (!empty($newIpAddress)) {
            $this->subDomain->setIpAddress($newIpAddress);
        }
        $subDomains = $this->config->getSubDomains();
        foreach ($subDomains as $subDomain) {
            $this->subDomain->setSubDomain($subDomain);
            $message = $this->subDomain->updateSubDomain();
            $output->writeln($message);
        }
        $output->writeln('All sub domains have been updated');
    }
}
