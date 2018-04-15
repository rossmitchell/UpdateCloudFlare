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

namespace RossMitchell\UpdateCloudFlare\Data;

use RossMitchell\UpdateCloudFlare\Exceptions\MissingConfigException;
use RossMitchell\UpdateCloudFlare\Interfaces\ConfigInterface;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class Config
 * @package RossMitchell\UpdateCloudFlare\Data
 */
class Config implements ConfigInterface
{
    const API_KEY       = 'api.credentials.key';
    const API_URL       = 'api.url';
    const BASE_DOMAIN   = 'domain_details.base_url';
    const EMAIL_ADDRESS = 'api.credentials.email';
    const SUB_DOMAINS   = 'domain_details.sub_domains';
    private $configDetails;

    /**
     * Config constructor.
     *
     * @param \PHLAK\Config\Config $config
     * @param string               $configFile
     *
     * @throws MissingConfigException
     */
    public function __construct(\PHLAK\Config\Config $config, string $configFile)
    {
        try {
            $config->load($configFile);
        } catch (\Error $error) {
            $code      = $error->getCode();
            $exception = new MissingConfigException("Could not find config file $configFile", $code, $error);
            throw $exception;

        }
        $this->configDetails = $config;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return (string) $this->get(self::EMAIL_ADDRESS);
    }

    /**
     * @param string $path
     *
     * @return mixed
     */
    private function get(string $path)
    {
        return $this->configDetails->get($path);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return (string) $this->get(self::API_KEY);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return (string) $this->get(self::BASE_DOMAIN);
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return (string) $this->get(self::API_URL);
    }

    /**
     * @return array
     * @throws LogicException
     */
    public function getSubDomains(): array
    {
        $subDomains = $this->get(self::SUB_DOMAINS);
        if (!\is_array($subDomains) && \is_string($subDomains)) {
            $subDomains = [$subDomains];
        }

        if (!\is_array($subDomains)) {
            throw new LogicException('The Sub Domains node must be a string or an array');
        }

        return $subDomains;
    }
}
