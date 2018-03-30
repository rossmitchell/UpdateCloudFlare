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

namespace RossMitchell\UpdateCloudFlare\Responses\Results;

use RossMitchell\UpdateCloudFlare\Helpers\Hydrator;
use Symfony\Component\Console\Exception\LogicException;

class Plan
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $price;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $frequency;
    /**
     * @var string
     */
    private $legacyId;
    /**
     * @var string
     */
    private $isSubscribed;
    /**
     * @var string
     */
    private $canSubscribe;

    /**
     * Plan constructor.
     *
     * @param Hydrator  $hydrator
     * @param \stdClass $data
     *
     * @throws LogicException
     */
    public function __construct(Hydrator $hydrator, \stdClass $data)
    {
        $hydrator->setProperty($this, $data, 'id');
        $hydrator->setProperty($this, $data, 'name');
        $hydrator->setProperty($this, $data, 'price');
        $hydrator->setProperty($this, $data, 'currency');
        $hydrator->setProperty($this, $data, 'frequency');
        $hydrator->setProperty($this, $data, 'legacy_id');
        $hydrator->setProperty($this, $data, 'is_subscribed');
        $hydrator->setProperty($this, $data, 'can_subscribe');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getFrequency(): string
    {
        return $this->frequency;
    }

    /**
     * @param string $frequency
     */
    public function setFrequency(string $frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @return string
     */
    public function getLegacyId(): string
    {
        return $this->legacyId;
    }

    /**
     * @param string $legacyId
     */
    public function setLegacyId(string $legacyId)
    {
        $this->legacyId = $legacyId;
    }

    /**
     * @return string
     */
    public function getisSubscribed(): string
    {
        return $this->isSubscribed;
    }

    /**
     * @param string $isSubscribed
     */
    public function setIsSubscribed(string $isSubscribed)
    {
        $this->isSubscribed = $isSubscribed;
    }

    /**
     * @return string
     */
    public function getCanSubscribe(): string
    {
        return $this->canSubscribe;
    }

    /**
     * @param string $canSubscribe
     */
    public function setCanSubscribe(string $canSubscribe)
    {
        $this->canSubscribe = $canSubscribe;
    }
}
