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

namespace RossMitchell\UpdateCloudFlare\Abstracts;

use Symfony\Component\Console\Exception\LogicException;

/**
 * Class CloudFlareResponse
 * @package RossMitchell\UpdateCloudFlare\Abstracts
 */
abstract class CloudFlareResponse
{
    /**
     * @var bool
     */
    private $success;
    /**
     * @var array
     */
    private $errors;
    /**
     * @var array
     */
    private $messages;
    private $resultInfo;

    /**
     * CloudFlareResponse constructor.
     *
     * @param string $rawResult
     *
     * @throws LogicException
     */
    public function __construct(string $rawResult)
    {
        $result = \json_decode($rawResult);
        if ($result === false) {
            throw new LogicException('Could not decode the result');
        }
        $this->success    = (bool)$this->getNode($result, 'success');
        $this->errors     = $this->getNode($result, 'errors');
        $this->messages   = $this->getNode($result, 'messages');
        $this->resultInfo = $this->getNode($result, 'result_info', false);
        $this->setResults($this->getNode($result, 'result'));
    }

    /**
     * @param $result
     */
    abstract public function setResult($result);

    /**
     * @return mixed
     */
    abstract public function getResult();

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return null
     */
    public function getResultInfo()
    {
        return $this->resultInfo;
    }


    /**
     * @param \stdClass $result
     * @param string    $node
     * @param bool      $required
     *
     * @return mixed
     */
    private function getNode(\stdClass $result, string $node, $required = true)
    {
        if (!\property_exists($result, $node)) {
            if ($required === true) {
                throw new LogicException("$node does not exist in the result");
            }

            return null;
        }

        return $result->$node;
    }
}
